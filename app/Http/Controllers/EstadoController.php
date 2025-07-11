<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Movimiento;

class EstadoController extends Controller
{
    // Mostrar estado financiero por año
    public function index(Request $request)
    {
        $anio = $request->input('anio', now()->year);
        $registroSaldoInicial = Estado::where('anio', $anio)->where('mes', 1)->first();

        $saldoAnterior = $registroSaldoInicial->saldo_inicial ?? $this->obtenerSaldoFinalAnterior($anio);
        $saldos = [];

        for ($mes = 1; $mes <= 12; $mes++) {
            // Entradas desde movimientos
            $entradas = Movimiento::whereYear('fecha', $anio)
                ->whereMonth('fecha', $mes)
                ->where('tipo', 'ingreso')
                ->sum('valor');

            // Salidas desde movimientos
            $salidas = Movimiento::whereYear('fecha', $anio)
                ->whereMonth('fecha', $mes)
                ->where('tipo', 'egreso')
                ->sum('valor');

            // Si es enero y hay saldo inicial registrado manual, usarlo
            if ($mes === 1 && $registroSaldoInicial) {
                $saldoInicial = $registroSaldoInicial->saldo_inicial;
            } else {
                $saldoInicial = $saldoAnterior;
            }

            $saldoFinal = $saldoInicial + $entradas - $salidas;

            $saldos[] = [
                'inicial' => $saldoInicial,
                'entradas' => $entradas,
                'salidas' => $salidas,
                'final' => $saldoFinal,
            ];

            $saldoAnterior = $saldoFinal;
        }

        return view('estado.index', compact('saldos', 'anio'));
    }

    // Obtener el saldo final del último mes del año anterior
    private function obtenerSaldoFinalAnterior($anio)
    {
        $registro = Estado::where('anio', $anio - 1)
            ->orderByDesc('mes')
            ->first();

        return $registro->saldo_final ?? 0;
    }

    // Mostrar formulario para ingresar el saldo inicial
    public function formSaldoInicial()
    {
        return view('estado.saldo-inicial');
    }

    // Guardar o actualizar saldo inicial del año
    public function guardarSaldoInicial(Request $request)
    {
        $request->validate([
            'anio' => 'required|digits:4|integer|min:2000',
            'saldo_inicial' => 'required|numeric|min:0',
        ]);

        $anio = $request->input('anio');
        $saldoInicial = $request->input('saldo_inicial');

        $estado = Estado::firstOrNew([
            'anio' => $anio,
            'mes' => 1,
        ]);

        $estado->saldo_inicial = $saldoInicial;

        // Extra: calcular entradas y salidas de enero automáticamente
        $entradas = Movimiento::whereYear('fecha', $anio)->whereMonth('fecha', 1)->where('tipo', 'ingreso')->sum('valor');
        $salidas = Movimiento::whereYear('fecha', $anio)->whereMonth('fecha', 1)->where('tipo', 'egreso')->sum('valor');

        $estado->entradas = $entradas;
        $estado->salidas = $salidas;
        $estado->saldo_final = $saldoInicial + $entradas - $salidas;

        $estado->save();

        return redirect()->route('estado.saldo-inicial.form')->with('success', 'Saldo inicial guardado correctamente.');
    }
}
