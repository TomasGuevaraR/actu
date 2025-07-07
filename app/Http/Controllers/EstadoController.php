<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
    // Mostrar estado financiero por año
    public function index(Request $request)
    {
        $anio = $request->input('anio', now()->year);
        $registros = Estado::where('anio', $anio)->orderBy('mes')->get()->keyBy('mes');

        $saldos = [];
        $saldoAnterior = $this->obtenerSaldoFinalAnterior($anio);

        for ($mes = 1; $mes <= 12; $mes++) {
            $registro = $registros[$mes] ?? null;
            $saldoInicial = $registro->saldo_inicial ?? $saldoAnterior;
            $entradas = $registro->entradas ?? 0;
            $salidas = $registro->salidas ?? 0;
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

    // Obtener el saldo final del año anterior
    private function obtenerSaldoFinalAnterior($anio)
    {
        $ultimoMes = Estado::where('anio', $anio - 1)
            ->orderByDesc('mes')
            ->first();

        return $ultimoMes->saldo_final ?? 0;
    }

    // Mostrar formulario para ingresar el saldo inicial del año
    public function formSaldoInicial()
    {
        return view('estado.saldo-inicial');
    }

    // Guardar o actualizar el saldo inicial del año
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
            'mes' => 1, // Enero
        ]);

        $estado->saldo_inicial = $saldoInicial;
        $estado->entradas = $estado->entradas ?? 0;
        $estado->salidas = $estado->salidas ?? 0;
        $estado->saldo_final = $saldoInicial + $estado->entradas - $estado->salidas;
        $estado->save();

        return redirect()->route('estado.saldo-inicial.form')->with('success', 'Saldo inicial guardado correctamente.');
    }

    // Otras funciones CRUD si algún día decides reutilizarlas
    // public function edit($id) { ... }
    // public function update(Request $request, $id) { ... }
    // public function destroy($id) { ... }
}
