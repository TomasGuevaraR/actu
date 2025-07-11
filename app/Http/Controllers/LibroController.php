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

        // 3. Recalcular el saldo para cada movimiento
        foreach ($movimientos as $mov) {
            if ($mov->tipo === 'ingreso') {
                $saldo += $mov->valor;
            } elseif ($mov->tipo === 'egreso') {
                $saldo -= $mov->valor;
            }

            // Guardar el saldo actual en una propiedad personalizada (no se guarda en la BD)
            $mov->saldo_actual = $saldo;
        }

        // 4. Revertir el orden para mostrar del más reciente al más antiguo
        $movimientos = $movimientos->sortByDesc('fecha');

        return view('libro.index', compact('movimientos'));
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
