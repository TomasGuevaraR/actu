@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">

<div class="max-w-7xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-[#0166b3]">
            <i class="bi bi-calculator-fill me-2"></i> Presupuesto Anual
        </h2>
            <a href="{{ route('presupuestos.create') }}" class="bg-[#0d6efd] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded-full">
                ➕ Crear Casilla
            </a>
        </div>
        <form method="GET" class="mb-4">
            <label for="año">Seleccionar año:</label>
                <select name="año" onchange="this.form.submit()" class="border p-1 rounded">
                    @for ($y = now()->year; $y >= 2024; $y--)
                        <option value="{{ $y }}" {{ $año == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
            </select>
        </form>
    </div>
    

</div>




            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="alert alert-success rounded-3">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla -->
<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 rounded shadow-sm">
        <thead class="bg-[#0166b3] text-white text-sm">
            <tr>
                <th class="py-2 px-4 border">Casilla</th>
                <th class="py-2 px-4 border">Tipo</th>
                <th class="py-2 px-4 border">Mensual</th>
                <th class="py-2 px-4 border">Año</th>
                <th class="py-2 px-4 border">Gastado</th>
                <th class="py-2 px-4 border">Disponible</th>
                <th class="py-2 px-4 border">Faltante</th>
                <th class="py-2 px-4 border text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-700">
            @forelse($presupuestos as $presupuesto)
                @php
                    $gastado = $presupuesto->movimientos->where('tipo', 'egreso')->sum('valor');
                    $mes_actual = now()->month;
                    $total_anual = $presupuesto->valor_mensual * 12;
                    $saldo_disponible = ($presupuesto->valor_mensual * $mes_actual) - $gastado;
                    $faltante = $total_anual - $gastado;
                @endphp
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $presupuesto->nombre_casilla }}</td>
                    <td class="py-2 px-4 border capitalize">{{ $presupuesto->tipo }}</td>
                    <td class="py-2 px-4 border">${{ number_format($presupuesto->valor_mensual, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border">${{ number_format($total_anual, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border">${{ number_format($gastado, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border {{ $saldo_disponible < 0 ? 'text-red-600 font-bold' : 'text-green-600' }}">
                        ${{ number_format($saldo_disponible, 0, ',', '.') }}
                    </td>
                    <td class="py-2 px-4 border">${{ number_format($faltante, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border text-center">
                        <a href="{{ route('presupuestos.edit', $presupuesto->id) }}" class="text-blue-600 hover:text-blue-800 mx-1" title="Editar">
                            ✏️
                        </a>
                        <form action="{{ route('presupuestos.destroy', $presupuesto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar esta casilla?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 mx-1" title="Eliminar">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">No hay presupuestos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
