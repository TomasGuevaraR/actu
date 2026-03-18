@extends('layouts.app')

@section('content')
    @php
        $rolUsuario = Auth::user()->rol ?? '';
    @endphp

    {{-- Bloquea a secretario --}}
    @if ($rolUsuario === 'secretario')
        <div class="container py-5 text-center">
            <div class="alert alert-danger fw-bold">
                🚫 No tienes permisos para acceder a este módulo.
            </div>
        </div>
    @else
        <div class="container py-4">
            <div class="card shadow-sm rounded-4">
                <div class="card-body">

                    <div class="max-w-7xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">

                        {{-- Encabezado --}}
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                            {{-- Botón Volver --}}
                            <div class="flex justify-start">
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
                                    <i class="fas fa-arrow-left mr-2"></i> Volver
                                </a>
                            </div>

                            {{-- Título --}}
                            <div class="flex-1 flex justify-center">
                                <h2 class="text-2xl font-bold text-[#0166b3] text-center">
                                    <i class="bi bi-calculator-fill me-2"></i> Presupuesto Anual
                                </h2>
                            </div>

                            {{-- Botón Crear --}}
                            <div class="flex justify-end">
                                @if ($rolUsuario === 'anciano')
                                    <a href="{{ route('presupuestos.create') }}"
                                        class="bg-[#0d6efd] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded-full">
                                        ➕ Crear Casilla
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Selector de año --}}
                        <form method="GET" class="mb-4">
                            <label for="año" class="mr-2">Seleccionar año:</label>
                            <select name="año" onchange="this.form.submit()" class="border p-1 rounded w-20">
                                @for ($y = now()->year; $y >= 2024; $y--)
                                    <option value="{{ $y }}" {{ $año == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </form>

                        {{-- Mensaje éxito --}}
                        @if(session('success'))
                            <div class="alert alert-success rounded-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Variables para totales --}}
                        @php
                            $total_mensual = 0;
                            $total_anual_total = 0;
                            $total_gastado = 0;
                            $total_disponible = 0;
                            $total_faltante = 0;
                        @endphp

                        {{-- Tabla --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-200 rounded shadow-sm">

                                <thead class="bg-[#0166b3] text-white text-sm">
                                    <tr>
                                        <th class="py-2 px-4 border">Casilla</th>
                                        <th class="py-2 px-4 border">Categoria</th>
                                        <th class="py-2 px-4 border">Mensual</th>
                                        <th class="py-2 px-4 border">Año</th>
                                        <th class="py-2 px-4 border">Gastado</th>
                                        <th class="py-2 px-4 border">Disponible</th>
                                        <th class="py-2 px-4 border">Faltante</th>
                                        <th class="py-2 px-4 border">Responsable</th>

                                        @if ($rolUsuario === 'anciano')
                                            <th class="py-2 px-4 border text-center">Acciones</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody class="text-sm text-gray-700">

                                    @forelse($presupuestos as $presupuesto)

                                        @php
                                            $gastado = $presupuesto->egresos->sum('valor');
                                            $mes_actual = now()->month;
                                            $total_anual = $presupuesto->valor_mensual * 12;
                                            $saldo_disponible = ($presupuesto->valor_mensual * $mes_actual) - $gastado;
                                            $faltante = $total_anual - $gastado;

                                            // acumuladores
                                            $total_mensual += $presupuesto->valor_mensual;
                                            $total_anual_total += $total_anual;
                                            $total_gastado += $gastado;
                                            $total_disponible += $saldo_disponible;
                                            $total_faltante += $faltante;
                                        @endphp

                                        <tr class="hover:bg-gray-100">

                                            <td class="py-2 px-4 border">
                                                {{ $presupuesto->nombre_casilla }}
                                            </td>

                                            <td class="py-2 px-4 border capitalize">
                                                {{ $presupuesto->categoria }}
                                            </td>

                                            <td class="py-2 px-4 border">
                                                ${{ number_format($presupuesto->valor_mensual, 0, ',', '.') }}
                                            </td>

                                            <td class="py-2 px-4 border">
                                                ${{ number_format($total_anual, 0, ',', '.') }}
                                            </td>

                                            <td class="py-2 px-4 border">
                                                ${{ number_format($gastado, 0, ',', '.') }}
                                            </td>

                                            <td
                                                class="py-2 px-4 border {{ $saldo_disponible < 0 ? 'text-red-600 font-bold' : 'text-green-600' }}">
                                                ${{ number_format($saldo_disponible, 0, ',', '.') }}
                                            </td>

                                            <td class="py-2 px-4 border">
                                                ${{ number_format($faltante, 0, ',', '.') }}
                                            </td>

                                            <td class="py-2 px-4 border">
                                                {{ $presupuesto->responsable ?? 'Sin asignar' }}
                                            </td>

                                            @if ($rolUsuario === 'anciano')
                                                <td class="py-2 px-4 border text-center">

                                                    <a href="{{ route('presupuestos.edit', $presupuesto->id) }}"
                                                        class="text-blue-600 hover:text-blue-800 mx-1">
                                                        ✏️
                                                    </a>

                                                    <form action="{{ route('presupuestos.destroy', $presupuesto->id) }}" method="POST"
                                                        class="inline-block" onsubmit="return confirm('¿Eliminar esta casilla?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="text-red-600 hover:text-red-800 mx-1">
                                                            🗑️
                                                        </button>

                                                    </form>

                                                </td>
                                            @endif

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="{{ $rolUsuario === 'anciano' ? '9' : '8' }}"
                                                class="text-center py-4 text-gray-500">
                                                No hay presupuestos registrados.
                                            </td>
                                        </tr>

                                    @endforelse

                                    {{-- FILA TOTAL --}}
                                    <tr class="bg-gray-200 font-bold">

                                        <td colspan="2" class="py-2 px-4 border text-right">
                                            TOTAL
                                        </td>

                                        <td class="py-2 px-4 border">
                                            ${{ number_format($total_mensual, 0, ',', '.') }}
                                        </td>

                                        <td class="py-2 px-4 border">
                                            ${{ number_format($total_anual_total, 0, ',', '.') }}
                                        </td>

                                        <td class="py-2 px-4 border">
                                            ${{ number_format($total_gastado, 0, ',', '.') }}
                                        </td>

                                        <td class="py-2 px-4 border">
                                            ${{ number_format($total_disponible, 0, ',', '.') }}
                                        </td>

                                        <td class="py-2 px-4 border">
                                            ${{ number_format($total_faltante, 0, ',', '.') }}
                                        </td>

                                        <td class="py-2 px-4 border"></td>

                                        @if ($rolUsuario === 'anciano')
                                            <td class="py-2 px-4 border"></td>
                                        @endif

                                    </tr>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection