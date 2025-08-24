<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\LibroContable;
use App\Models\LibroContableEstado;
use Carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Formulario de ingreso.
     */
    public function create()
    {
        return view('ingresos.create');
    }

    /**
     * Guardar ingreso en movimientos.
     */
    public function store(Request $request)
    {
        // Validación base (consecutivo ya no es obligatorio)
        $request->validate([
            'fecha'       => 'required|date',
            'consecutivo' => 'nullable|string|unique:movimientos,consecutivo',
            'detalle'     => 'required|string|max:255',
            'concepto'    => 'required|string|max:255',
            'valor'       => 'required|numeric|min:0',
        ]);

        // 1) Buscar el ID del estado "Abierto"
        $estadoAbiertoId = LibroContableEstado::where('nombre', 'Abierto')->value('id');
        if (!$estadoAbiertoId) {
            return back()->withErrors([
                'error' => 'No está configurado el estado "Abierto" en libro_contable_estados.'
            ])->withInput();
        }

        // 2) Obtener libro activo
        $libroActual = LibroContable::where('estado_id', $estadoAbiertoId)->first();
        if (!$libroActual) {
            return back()->withErrors([
                'error' => 'No hay ningún libro contable abierto.'
            ])->withInput();
        }

        // 3) Validar que la fecha sea del mismo mes/año del libro activo
        $fechaIngresada = Carbon::parse($request->fecha);
        if ((int)$fechaIngresada->month !== (int)$libroActual->mes_libro ||
            (int)$fechaIngresada->year  !== (int)$libroActual->anio_libro) {

            return back()->withErrors([
                'fecha' => 'La fecha debe pertenecer al libro activo: ' . $libroActual->nombre . '.'
            ])->withInput();
        }

        // 4) Calcular saldo
        $saldoAnterior = Movimiento::where('libro_contable_id', $libroActual->id)
            ->orderByDesc('id')
            ->value('saldo') ?? 0;
        $saldoActual = $saldoAnterior + (float)$request->valor;

        // 5) Generar consecutivo si viene vacío
        $consecutivo = $request->consecutivo;
        if (!$consecutivo) {
            $ultimo = Movimiento::where('libro_contable_id', $libroActual->id)
                ->max('consecutivo');
            $consecutivo = $ultimo ? $ultimo + 1 : 1;
        }

        // 6) Guardar movimiento
        Movimiento::create([
            'fecha'             => $request->fecha,
            'consecutivo'       => $consecutivo,
            'detalle'           => $request->detalle,
            'concepto'          => $request->concepto,
            'valor'             => (float)$request->valor,
            'tipo'              => 'ingreso',
            'saldo'             => $saldoActual,
            'libro_contable_id' => $libroActual->id,
        ]);

        // Redirigir
        return redirect()->route('libro.index')
            ->with('success', 'Ingreso registrado correctamente.');
    }
}
