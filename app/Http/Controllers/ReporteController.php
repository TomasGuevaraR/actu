<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movimiento;
use App\Models\Diezmo;
use App\Models\Miembro;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DiezmoExport;

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
                    'ausente', 'fallecido', 'trasladado', 'no bautizado'
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

    public function diezmo(Request $request)
    {
        // Obtener nombres de miembros registrados
        $miembros = Miembro::selectRaw("CONCAT(nombres, ' ', apellidos) AS nombre_completo")
            ->orderBy('nombres')
            ->pluck('nombre_completo');

        // Consulta base de diezmos
        $query = Diezmo::query()
            ->select([
                'nombre',
                DB::raw('SUM(valor) as total'),
                DB::raw('DATE(fecha) as fecha')
            ])
            ->groupBy('nombre', 'fecha')
            ->orderBy('fecha', 'desc');

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

        $diezmos = $query->get();

        return view('reporte.diezmo', compact('diezmos', 'miembros'));
    }

    public function exportarExcel(Request $request)
{
    return Excel::download(new DiezmoExport($request), 'reporte_diezmos.xlsx');
}
}
