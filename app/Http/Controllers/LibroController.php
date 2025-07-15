<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Estado;
use Carbon\Carbon;

class LibroController extends Controller
{
    /**
     * Muestra todos los movimientos del libro contable con saldo actualizado.
     */
    public function index()
    {
        // 1. Obtener el último saldo final del estado financiero
        $estado = Estado::orderBy('anio', 'desc')->orderBy('mes', 'desc')->first();
        $saldo = $estado ? $estado->saldo_final : 0;

        // 2. Obtener los movimientos ordenados por fecha ascendente (para procesar saldo correctamente)
        $movimientos = Movimiento::orderBy('fecha', 'asc')->get();

        $totalEntradas = 0;
        $totalSalidas = 0;
        $saldoFinal = $saldo; // Copia del saldo original

        // 3. Recalcular el saldo para cada movimiento
        foreach ($movimientos as $mov) {
            if ($mov->tipo === 'ingreso') {
                $saldoFinal += $mov->valor;
                $totalEntradas += $mov->valor;
            } elseif ($mov->tipo === 'egreso') {
                $saldoFinal -= $mov->valor;
                $totalSalidas += $mov->valor;
            }

            // Guardar el saldo actual para cada fila
            $mov->saldo_actual = $saldoFinal;
        }

        // 4. Revertir el orden para mostrar del más reciente al más antiguo
        $movimientos = $movimientos->sortBy('fecha');


        // 5. Enviar también los totales para mostrar en el pie
        return view('libro.index', compact('movimientos', 'totalEntradas', 'totalSalidas', 'saldoFinal'));
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
