@extends('layouts.app')

@section('content')
@php
    // Detectar el rol actual (independiente de mayúsculas/minúsculas)
    $rawRole = Auth::user()->rol ?? Auth::user()->role ?? '';
    $rol = is_string($rawRole) ? strtolower($rawRole) : '';
@endphp

{{-- Bloqueo total para SECRETARIO --}}
@if ($rol === 'secretario')
<div class="max-w-3xl mx-auto mt-20 p-8 bg-white shadow-md rounded-lg text-center">
    <h2 class="text-2xl font-bold text-red-600">Acceso denegado</h2>
    <p class="text-gray-700 mt-3">No tienes permisos para acceder a esta sección.</p>
    <a href="{{ route('dashboard') }}"
       class="inline-flex items-center mt-6 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-800 transition">
       <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
    </a>
</div>
@else

<div class="container mx-auto p-6">

    <div class="relative flex items-center justify-between mb-6">
        {{-- Botón Volver --}}
        <a href="{{ route('dashboard') }}" 
            class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>

        {{-- Título centrado --}}
        <h1 class="absolute left-1/2 transform -translate-x-1/2 text-2xl font-bold text-gray-700 text-center">
            📊 Estado Financiero Anual - {{ $anio }}
        </h1>

        {{-- Botón solo para TESORERO --}}
        @if ($rol === 'tesorero')
            <a href="{{ route('estado.saldo-inicial.form') }}"
                class="bg-[#0166b3] hover:bg-[#014a82] text-white font-semibold py-2 px-4 rounded shadow flex items-center gap-2">
                <i class="bi bi-plus-circle"></i> Ingresar Saldo Inicial
            </a>
        @else
            <div></div> {{-- Para mantener alineación --}}
        @endif
    </div>

    {{-- Filtro por año --}}
    <form method="GET" action="{{ route('estado.index') }}" class="mb-6 flex items-center gap-3">
        <label for="anio" class="font-medium text-gray-700">Seleccionar año:</label>
        <select name="anio" id="anio" onchange="this.form.submit()"
                class="w-40 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0166b3] text-sm">
            @for ($a = now()->year; $a >= now()->year - 5; $a--)
                <option value="{{ $a }}" {{ $a == $anio ? 'selected' : '' }}>{{ $a }}</option>
            @endfor
        </select>
    </form>

    {{-- Tabla de saldos --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
            <thead class="bg-[#0166b3] text-white uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Mes</th>
                    <th class="px-4 py-2 text-left font-medium">Saldo Inicial</th>
                    <th class="px-4 py-2 text-left font-medium">Entradas</th>
                    <th class="px-4 py-2 text-left font-medium">Salidas</th>
                    <th class="px-4 py-2 text-left font-medium">Saldo Final</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $meses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    $saldoFinal = 0;
                @endphp
                @foreach($meses as $i => $mes)
                    <tr>
                        <td class="px-4 py-2">{{ $mes }}</td>
                        <td class="px-4 py-2">${{ number_format($saldos[$i]['inicial'], 2) }}</td>
                        <td class="px-4 py-2 text-green-600">${{ number_format($saldos[$i]['entradas'], 2) }}</td>
                        <td class="px-4 py-2 text-red-600">${{ number_format($saldos[$i]['salidas'], 2) }}</td>
                        <td class="px-4 py-2 font-semibold">${{ number_format($saldos[$i]['final'], 2) }}</td>
                        @php $saldoFinal = $saldos[$i]['final']; @endphp
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-semibold text-gray-800 text-sm">
                    <td colspan="4" class="px-4 py-2 text-right">Saldo Final del Año:</td>
                    <td class="px-4 py-2">${{ number_format($saldoFinal, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
@endif
@endsection
