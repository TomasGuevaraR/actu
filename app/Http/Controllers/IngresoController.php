<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\LibroContable;
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
        // ============================
        // 1) Buscar libro contable activo
        // ============================
        $libro = LibroContable::where('estado', 'activo')->first();

        if (!$libro) {
            return back()->withErrors([
                'error' => 'No hay un libro contable activo.'
            ])->withInput();
        }

        // ============================
        // 2) Calcular rango de fechas permitido
        // ============================
        $fechaInicio = Carbon::createFromDate($libro->anio_libro, $libro->mes_libro, 1)->startOfMonth();
        $fechaFin    = (clone $fechaInicio)->endOfMonth();

        // ============================
        // 3) Validar datos de entrada (incluye rango de fechas)
        // ============================
        $request->validate([
            'fecha'       => [
                'required',
                'date',
                'after_or_equal:' . $fechaInicio->format('Y-m-d'),
                'before_or_equal:' . $fechaFin->format('Y-m-d'),
            ],
            'consecutivo' => 'nullable|string|unique:movimientos,consecutivo',
            'detalle'     => 'required|string|max:255',
            'concepto'    => 'required|string|max:255',
            'valor'       => 'required|numeric|min:0',
        ], [
            'fecha.after_or_equal'  => 'La fecha debe estar entre ' . $fechaInicio->format('d/m/Y') . 
                                        ' y ' . $fechaFin->format('d/m/Y') . ' (Libro activo: ' . $libro->nombre . ')',
            'fecha.before_or_equal' => 'La fecha debe estar entre ' . $fechaInicio->format('d/m/Y') . 
                                        ' y ' . $fechaFin->format('d/m/Y') . ' (Libro activo: ' . $libro->nombre . ')',
        ]);

        // ============================
        // 4) Calcular saldo
        // ============================
        $saldoAnterior = Movimiento::where('libro_contable_id', $libro->id)
            ->orderByDesc('id')
            ->value('saldo') ?? 0;
        $saldoActual = $saldoAnterior + (float)$request->valor;

        // ============================
        // 5) Generar consecutivo si viene vacío
        // ============================
        // ============================
// 5) Manejo del consecutivo
// ============================
        $consecutivo = $request->filled('consecutivo') ? $request->consecutivo : null;

        // Validar que no se repita
        if ($consecutivo && Movimiento::where('consecutivo', $consecutivo)->exists()) {
            return back()->withErrors([
                'consecutivo' => 'El consecutivo ya está en uso.'
            ])->withInput();
        }

        // ============================
        // 6) Guardar movimiento
        // ============================
        Movimiento::create([
            'fecha'             => $request->fecha,
            'consecutivo'       => $consecutivo,
            'detalle'           => $request->detalle,
            'concepto'          => $request->concepto,
            'valor'             => (float)$request->valor,
            'tipo'              => 'ingreso',
            'saldo'             => $saldoActual,
            'libro_contable_id' => $libro->id,
        ]);

        return redirect()->route('libro.index')
            ->with('success', 'Ingreso registrado correctamente.');
    }
}
