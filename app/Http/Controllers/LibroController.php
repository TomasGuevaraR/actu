<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Estado;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{
    /**
     * Muestra los movimientos agrupados (por consecutivo) con saldo actualizado.
     */
    public function index()
    {
        // 1) Saldo base desde estados financieros
        $estado = Estado::orderBy('anio', 'desc')
            ->orderBy('mes', 'desc')
            ->first();
        $saldoInicial = $estado ? $estado->saldo_final : 0;

        // 2) Traer movimientos agregados por consecutivo
        //    - MIN(id) como id de referencia para las rutas (edit/destroy)
        //    - GROUP_CONCAT de casillas para mostrarlas juntas
        //    - SUM de ingresos/egresos para el total por operación
        $movimientosAgrupados = Movimiento::select(
                DB::raw('MIN(id) as id'),
                'consecutivo',
                'fecha',
                'detalle',
                'concepto',
                DB::raw("GROUP_CONCAT(casilla ORDER BY casilla SEPARATOR ', ') as casillas"),
                DB::raw("SUM(CASE WHEN tipo = 'ingreso' THEN valor ELSE 0 END) as total_ingreso"),
                DB::raw("SUM(CASE WHEN tipo = 'egreso' THEN valor ELSE 0 END) as total_egreso")
            )
            ->groupBy('consecutivo', 'fecha', 'detalle', 'concepto')
            ->orderBy('fecha', 'asc')
            ->get();

        // 3) Calcular saldo acumulado y totales
        $saldoFinal = $saldoInicial;
        $totalEntradas = 0;
        $totalSalidas = 0;

        foreach ($movimientosAgrupados as $mov) {
            if ($mov->total_ingreso > 0) {
                $saldoFinal += $mov->total_ingreso;
                $totalEntradas += $mov->total_ingreso;
            }
            if ($mov->total_egreso > 0) {
                $saldoFinal -= $mov->total_egreso;
                $totalSalidas += $mov->total_egreso;
            }

            // Campo calculado para la vista (no existe en BD)
            $mov->saldo_actual = $saldoFinal;
        }

        // 4) Mostrar más recientes primero
        $movimientos = $movimientosAgrupados->sortByDesc('fecha');

        // 5) Enviar a la vista
        return view('libro.index', compact(
            'movimientos',
            'totalEntradas',
            'totalSalidas',
            'saldoFinal'
        ));
    }

    public function crearIngreso()
    {
        return view('ingresos.create');
    }

    public function crearEgreso()
    {
        return view('egresos.create');
    }

    public function verDiezmos()
    {
        return view('diezmo.index');
    }
}
