<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movimiento;
use App\Models\Diezmo;
use App\Models\Miembro;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DiezmoExport;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;
use App\Models\LibroContable;
use Illuminate\Support\Facades\Auth;


class ReporteController extends Controller
{
    public function index(Request $request)
    {
        try {
            // 1. Obtener el año seleccionado (con valor por defecto)
            $anioSeleccionado = $request->get('anio', date('Y'));

            // 2. Obtener años disponibles (desde movimientos)
            $aniosDisponibles = Movimiento::selectRaw('YEAR(fecha) as anio')
                ->distinct()
                ->orderBy('anio', 'desc')
                ->pluck('anio')
                ->toArray();

            if (empty($aniosDisponibles)) {
                $aniosDisponibles = [date('Y')];
            }

            // 3. Configurar meses y arrays iniciales
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

            $ingresosMensuales = array_fill(0, 12, 0);
            $egresosMensuales = array_fill(0, 12, 0);

            // 4. Obtener datos de movimientos
            $movimientos = Movimiento::whereYear('fecha', $anioSeleccionado)
                ->selectRaw('MONTH(fecha) as mes, tipo, SUM(valor) as total')
                ->groupBy('mes', 'tipo')
                ->get();

            // 5. Procesar movimientos
            foreach ($movimientos as $movimiento) {
                $indiceMes = $movimiento->mes - 1;
                if ($movimiento->tipo === 'ingreso') {
                    $ingresosMensuales[$indiceMes] = (float)$movimiento->total;
                } elseif ($movimiento->tipo === 'egreso') {
                    $egresosMensuales[$indiceMes] = (float)$movimiento->total;
                }
            }

            // 6. Obtener estados de miembros
            $estadosMiembros = Miembro::select('estado', DB::raw('COUNT(*) as total'))
                ->whereIn('estado', [
                    'activo', 'inactivo', 'con excusa', 'borrado',
                    'ausente', 'fallecido', 'trasladado', 'no bautizado', 'disciplina',
                ])
                ->groupBy('estado')
                ->orderBy('total', 'desc')
                ->get()
                ->pluck('total', 'estado')
                ->toArray();

            return view('reporte.index', [
                'anioSeleccionado' => $anioSeleccionado,
                'aniosDisponibles' => $aniosDisponibles,
                'meses' => $meses,
                'ingresosMensuales' => $ingresosMensuales,
                'egresosMensuales' => $egresosMensuales,
                'estadosMiembros' => $estadosMiembros
            ]);
        } catch (\Exception $e) {
            return redirect()->route('reporte.index')
                ->with('error', 'Error al cargar los datos: ' . $e->getMessage())
                ->withInput();
        }
    }

    // DETALLE – Reporte agrupado por nombre y fecha
    public function diezmo(Request $request)
{
    $miembros = Miembro::selectRaw("CONCAT(nombres, ' ', apellidos) AS nombre_completo")
        ->orderBy('nombres')
        ->pluck('nombre_completo');

    $query = Diezmo::query()
        ->select([
            'nombre',
            DB::raw('SUM(valor) as total'),
            DB::raw('DATE(fecha) as fecha')
        ])
        ->groupBy('nombre', 'fecha')
        ->orderBy('fecha', 'desc');

    // ✅ Si NO hay filtros → mostrar solo el último mes registrado
    if (
        !$request->filled('nombre') &&
        !$request->filled('fecha') &&
        !$request->filled('mes') &&
        !$request->filled('anio')
    ) {
        $ultimaFecha = Diezmo::max('fecha');

        if ($ultimaFecha) {
            $ultimoMes = Carbon::parse($ultimaFecha)->month;
            $ultimoAnio = Carbon::parse($ultimaFecha)->year;

            $query->whereMonth('fecha', $ultimoMes)
                  ->whereYear('fecha', $ultimoAnio);
        }
    }

    // 🔎 Filtros normales (si el usuario usa el formulario)
    if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('fecha')) {
        $query->whereDate('fecha', $request->fecha);
    }

    if ($request->filled('mes')) {
        $query->whereMonth('fecha', $request->mes);
    }

    if ($request->filled('anio')) {
        $query->whereYear('fecha', $request->anio);
    }

    $diezmos = $query->get();
    $total = $diezmos->sum('total');

    return view('reporte.diezmo', compact('diezmos', 'miembros', 'total'));
}

    // EXPORTAR – Reporte a Excel
    public function exportarCSV(Request $request)
{
    $query = Diezmo::query()->select('nombre', 'valor', 'fecha');

    // Filtros
    if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }
    if ($request->filled('fecha')) {
        $query->whereDate('fecha', $request->fecha);
    }
    if ($request->filled('mes')) {
        $query->whereMonth('fecha', $request->mes);
    }
    if ($request->filled('anio')) {
        $query->whereYear('fecha', $request->anio);
    }

    $diezmos = $query->orderBy('nombre')->get();

    return response()->stream(function () use ($diezmos) {
        $handle = fopen('php://output', 'w');
        fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM para Excel

        // Cabeceras
        fputcsv($handle, ['Nombre', 'Valor', 'Fecha'], ';');

        foreach ($diezmos as $diezmo) {
            fputcsv($handle, [
                $diezmo->nombre,
                $diezmo->valor,
                Carbon::parse($diezmo->fecha)->format('d/m/Y'),
            ], ';');
        }

        fclose($handle);
    }, 200, [
        "Content-Type" => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=reporte_diezmos_" . now()->format("Ymd_His") . ".csv"
    ]);
}


public function libros(Request $request)
{
    try {
        // Parámetros seleccionados (por defecto año/mes actual)
        $anioSeleccionado = $request->get('anio', date('Y'));
        $mesSeleccionado  = $request->get('mes', date('m'));

        // Años disponibles desde movimientos
        $aniosDisponibles = Movimiento::selectRaw('YEAR(fecha) as anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio')
            ->toArray();

        if (empty($aniosDisponibles)) {
            $aniosDisponibles = [date('Y')];
        }

        // Obtener el libro contable para el mes/año seleccionados
        $libro = LibroContable::where('anio_libro', $anioSeleccionado)
                    ->where('mes_libro', $mesSeleccionado)
                    ->first();

        // Valores por defecto
        $saldoInicial = 0;
        $movimientos = collect();

        if ($libro) {
            // 1) Si el libro tiene columna saldo_inicial definida, úsala
            if (!is_null($libro->saldo_inicial) && $libro->saldo_inicial !== '') {
                $saldoInicial = (float) $libro->saldo_inicial;
            } else {
                // 2) Si no, intentar calcularlo desde el último movimiento del libro anterior
                $mesAnterior = (int)$mesSeleccionado - 1;
                $anioAnterior = (int)$anioSeleccionado;
                if ($mesAnterior === 0) {
                    $mesAnterior = 12;
                    $anioAnterior--;
                }

                $libroAnterior = LibroContable::where('anio_libro', $anioAnterior)
                    ->where('mes_libro', $mesAnterior)
                    ->first();

                if ($libroAnterior) {
                    $ultimoMovimientoAnterior = Movimiento::where('libro_contable_id', $libroAnterior->id)
                        ->orderBy('fecha', 'desc')
                        ->orderBy('id', 'desc')
                        ->first();

                    if ($ultimoMovimientoAnterior) {
                        $saldoInicial = (float) $ultimoMovimientoAnterior->saldo;
                    }
                }
            }

            // 3) Obtener movimientos del libro actual (ordenados)
            $movimientos = Movimiento::where('libro_contable_id', $libro->id)
                ->orderBy('fecha')
                ->orderBy('id')
                ->get();

            // 4) Buscar si hay un movimiento real con detalle "Saldo inicial del mes"
            $movSaldo = $movimientos->first(function ($m) {
                return isset($m->detalle)
                    && strcasecmp(trim($m->detalle), 'Saldo inicial del mes') === 0;
            });

            if ($movSaldo) {
                // Si existe, usamos su saldo (si tiene) y lo ponemos primero
                if (isset($movSaldo->saldo)) {
                    $saldoInicial = (float) $movSaldo->saldo;
                }

                // Reordenamos para que ese movimiento sea el primero
                $movimientos = $movimientos->filter(function ($m) use ($movSaldo) {
                    return $m->id !== $movSaldo->id;
                });
                $movimientos->prepend($movSaldo);
            } else {
                // 5) No existe: crear un movimiento sintético (NO guardado en BD) y ponerlo primero
                $synthetic = new Movimiento(); // objeto Eloquent no persistido
                // fecha: primer día del mes seleccionado (formato Y-m-d)
                try {
                    $synthetic->fecha = \Carbon\Carbon::createFromDate($anioSeleccionado, $mesSeleccionado, 1)->format('Y-m-d');
                } catch (\Exception $e) {
                    $synthetic->fecha = sprintf('%04d-%02d-01', $anioSeleccionado, $mesSeleccionado);
                }
                $synthetic->consecutivo = null;
                $synthetic->detalle = 'Saldo inicial del mes';
                $synthetic->concepto = null;
                $synthetic->casilla = null;
                $synthetic->valor = 0;
                $synthetic->tipo = null;
                $synthetic->saldo = $saldoInicial;
                $synthetic->libro_contable_id = $libro->id;
                $synthetic->id = 0; // id ficticio

                // Colocar al inicio de la colección
                $movimientos->prepend($synthetic);
            }
        }

        // Rol de usuario para la vista
        $rolUsuario = Auth::user()->rol ?? '';

        return view('reporte.libros', [
            'anioSeleccionado' => $anioSeleccionado,
            'mesSeleccionado'  => $mesSeleccionado,
            'aniosDisponibles' => $aniosDisponibles,
            'libro'            => $libro,
            'movimientos'      => $movimientos,
            'saldoInicial'     => $saldoInicial,
            'rolUsuario'       => $rolUsuario,
        ]);
    } catch (\Exception $e) {
        return redirect()->route('dashboard')
            ->with('error', 'Error al generar el reporte: ' . $e->getMessage());
    }
}
// ReporteController.php (añadir/pegar este método)
public function exportarLibrosCSV(Request $request)
{
    $anio = $request->get('anio', date('Y'));
    $mes  = $request->get('mes', date('m'));

    $libro = \App\Models\LibroContable::where('anio_libro', $anio)
        ->where('mes_libro', $mes)
        ->first();

    if (! $libro) {
        return redirect()->back()->with('error', 'No se encontró libro para ese periodo.');
    }

    // Obtener movimientos del libro (desde BD)
    $movimientos = \App\Models\Movimiento::where('libro_contable_id', $libro->id)
        ->orderBy('fecha')
        ->orderBy('id')
        ->get();

    // Determinar saldo inicial:
    // - Primero: si el libro tiene saldo_inicial usarlo
    // - Si no: intentar obtenerlo del último movimiento del libro anterior
    $saldoInicial = 0;
    if (!is_null($libro->saldo_inicial) && $libro->saldo_inicial !== '') {
        $saldoInicial = (float) $libro->saldo_inicial;
    } else {
        $mesAnterior = (int)$mes - 1;
        $anioAnterior = (int)$anio;
        if ($mesAnterior === 0) {
            $mesAnterior = 12;
            $anioAnterior--;
        }
        $libroAnterior = \App\Models\LibroContable::where('anio_libro', $anioAnterior)
            ->where('mes_libro', $mesAnterior)
            ->first();

        if ($libroAnterior) {
            $ultimoMovimientoAnterior = \App\Models\Movimiento::where('libro_contable_id', $libroAnterior->id)
                ->orderBy('fecha', 'desc')
                ->orderBy('id', 'desc')
                ->first();
            if ($ultimoMovimientoAnterior) {
                $saldoInicial = (float) $ultimoMovimientoAnterior->saldo;
            }
        }
    }

    // Revisar si existe un movimiento real con detalle "Saldo inicial del mes"
    $movSaldoReal = $movimientos->first(function ($m) {
        return isset($m->detalle) && strcasecmp(trim($m->detalle), 'Saldo inicial del mes') === 0;
    });

    // Si existe, usar su saldo como inicial (si tiene)
    if ($movSaldoReal) {
        $saldoInicial = (float) ($movSaldoReal->saldo ?? $movSaldoReal->valor ?? $saldoInicial);
        // reordenar para que aparezca primero
        $movimientos = $movimientos->filter(fn($m) => $m->id !== $movSaldoReal->id);
        $movimientos->prepend($movSaldoReal);
        $tieneMovSaldoReal = true;
    } else {
        $tieneMovSaldoReal = false;
    }

    // Ahora hacemos el stream del CSV: calculamos running balance igual que la vista
    return response()->stream(function () use ($movimientos, $saldoInicial, $anio, $mes, $tieneMovSaldoReal) {
        $handle = fopen('php://output', 'w');
        // BOM UTF-8
        fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Cabecera
        fputcsv($handle, ['Fecha', 'Consecutivo', 'Detalle', 'Concepto', 'Casilla', 'Valor', 'Entrada', 'Salida', 'Saldo'], ';');

        $running = (float) $saldoInicial;

        // Si NO existe movimiento real de saldo inicial, escribimos una fila inicial sintética
        if (! $tieneMovSaldoReal) {
            fputcsv($handle, [
                sprintf('%04d-%02d-01', $anio, $mes),
                '',
                'Saldo inicial del mes',
                '',
                '',
                '0',
                '0',
                '0',
                number_format($running, 2, '.', ''), // saldo inicial
            ], ';');
        }

        $totalEntradas = 0;
        $totalSalidas  = 0;

        foreach ($movimientos as $mov) {
            // entrada / salida según tipo
            $entrada = ($mov->tipo === 'ingreso') ? (float) $mov->valor : 0.0;
            $salida  = ($mov->tipo === 'egreso') ? (float) $mov->valor : 0.0;

            // Para reproducir exactamente la lógica de la vista:
            // la vista hace: ultimoSaldo += entrada - salida; luego muestra ultimoSaldo.
            $running += $entrada - $salida;

            $totalEntradas += $entrada;
            $totalSalidas  += $salida;

            fputcsv($handle, [
                $mov->fecha,
                $mov->consecutivo ?? '',
                $mov->detalle ?? '',
                $mov->concepto ?? '',
                $mov->casilla ?? '',
                number_format((float)$mov->valor, 2, '.', ''),
                number_format($entrada, 2, '.', ''),
                number_format($salida, 2, '.', ''),
                number_format($running, 2, '.', ''),
            ], ';');
        }

        // Fila final de totales (opcional)
        fputcsv($handle, ['', '', 'Totales', '', '', '', number_format($totalEntradas, 2, '.', ''), number_format($totalSalidas, 2, '.', ''), number_format($running, 2, '.', '')], ';');

        fclose($handle);
    }, 200, [
        "Content-Type" => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=reporte_libro_{$anio}_{$mes}_" . now()->format("Ymd_His") . ".csv"
    ]);
}



}