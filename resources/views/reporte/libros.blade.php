@extends('layouts.app')

@section('content')
@php
    $rolUsuario = Auth::user()->rol ?? '';
@endphp

<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6 text-center">Reporte de Libros Contables</h1>
    
    <div class="flex justify-between items-center mb-4">
    {{-- Botón Volver --}}
    <a href="{{ route('reporte.index') }}" 
        class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition shadow-sm">
        <i class="fas fa-arrow-left mr-2"></i> Volver
    </a>

    {{-- Botón Exportar --}}
    <a href="{{ route('reportes.libros.exportar', ['anio' => $anioSeleccionado, 'mes' => $mesSeleccionado]) }}" 
        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition shadow-sm">
        <i class="fas fa-file-csv mr-2"></i> Exportar CSV
    </a>
</div>

</div>



    {{-- Filtro por Año y Mes --}}
    <form method="GET" action="{{ route('reporte.libros') }}" class="mb-8 bg-white p-4 rounded shadow">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="anio" class="block text-gray-700">Selecciona el año:</label>
                <select name="anio" id="anio" class="border border-gray-300 rounded px-3 py-2 w-full">
                    @foreach ($aniosDisponibles as $opcion)
                        <option value="{{ $opcion }}" {{ $opcion == $anioSeleccionado ? 'selected' : '' }}>
                            {{ $opcion }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="mes" class="block text-gray-700">Selecciona el mes:</label>
                <select name="mes" id="mes" class="border border-gray-300 rounded px-3 py-2 w-full">
                    @foreach ([
                        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 
                        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                    ] as $num => $nombre)
                        <option value="{{ $num }}" {{ $num == $mesSeleccionado ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800 w-full">
                    Generar Reporte
                </button>
            </div>
        </div>
    </form>

    {{-- Información del libro --}}
@if($libro)
    @php
        // Buscar el movimiento que corresponde al saldo inicial
        $movSaldoInicial = $movimientos->firstWhere('detalle', 'Saldo inicial del mes');
        $saldoInicialReal = $movSaldoInicial ? (float) $movSaldoInicial->valor : 0;
    @endphp

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold text-blue-700 mb-2">
            Libro Contable: {{ [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 
                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ][$libro->mes_libro] }} de {{ $libro->anio_libro }}
        </h2>
        <p class="text-gray-600">
            Estado: 
            <span class="font-semibold {{ $libro->estado == 'activo' ? 'text-green-600' : 'text-gray-600' }}">
                {{ ucfirst($libro->estado) }}
            </span>
        </p>
        <p class="text-gray-600 mt-2">
            Saldo Inicial:
            <span class="font-semibold {{ $saldoInicial >= 0 ? 'text-green-600' : 'text-red-600' }}">
                ${{ number_format($saldoInicial, 0, ',', '.') }}
            </span>
        </p>
        
    </div>
@endif


    {{-- Tabla de movimientos --}}
            @if($libro && $movimientos->count() > 0)
            @php
                // 1) Detectar saldo inicial desde el primer movimiento o desde el controlador
                $movSaldoInicial = $movimientos->firstWhere('detalle', 'Saldo inicial del mes');
                $saldoInicialReal = $movSaldoInicial
                    ? (float) ($movSaldoInicial->saldo ?? $movSaldoInicial->valor ?? 0)
                    : (float) ($saldoInicial ?? 0);

                // 2) Inicializar acumuladores
                $totalEntradas = 0;
                $totalSalidas  = 0;
                $ultimoSaldo   = $saldoInicialReal;
            @endphp

    <div class="bg-white rounded shadow overflow-hidden">
        <div class="card-body px-3 py-3">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded shadow-sm text-xs">
                    <thead class="bg-[#0166b3] text-white text-xs">
                        <tr>
                            <th class="py-2 px-3 border">Fecha</th>
                            <th class="py-2 px-3 border">Consecutivo</th>
                            <th class="py-2 px-3 border">Detalle</th>
                            <th class="py-2 px-3 border">Concepto</th>
                            <th class="py-2 px-3 border">Casillas</th>
                            <th class="py-2 px-3 border">Valor</th>
                            <th class="py-2 px-3 border">Entrada</th>
                            <th class="py-2 px-3 border">Salida</th>
                            <th class="py-2 px-3 border">Saldo</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-gray-700">
                        @foreach ($movimientos as $mov)
                            @php
                                $entrada = $mov->tipo === 'ingreso' ? (float) $mov->valor : 0;
                                $salida  = $mov->tipo === 'egreso' ? (float) $mov->valor : 0;
                                $ultimoSaldo += $entrada - $salida;
                                $totalEntradas += $entrada;
                                $totalSalidas  += $salida;
                            @endphp
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-3 border">{{ $mov->fecha }}</td>
                                <td class="py-2 px-3 border">{{ $mov->consecutivo ?? '-' }}</td>
                                <td class="py-2 px-3 border">{{ $mov->detalle }}</td>
                                <td class="py-2 px-3 border">{{ $mov->concepto }}</td>
                                <td class="py-2 px-3 border">{{ $mov->casilla ?? '-' }}</td>
                                <td class="py-2 px-3 border">{{ number_format($mov->valor ?? 0, 0, ',', '.') }}</td>
                                <td class="py-2 px-3 border text-green-600 font-semibold">
                                    {{ $entrada > 0 ? number_format($entrada, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-2 px-3 border text-red-600 font-semibold">
                                    {{ $salida > 0 ? number_format($salida, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-2 px-3 border font-semibold">
                                    {{ number_format($ultimoSaldo, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-100 text-xs font-semibold">
                        <tr>
                            <td colspan="6" class="py-2 px-3 text-right">Totales:</td>
                            <td class="py-2 px-3 text-green-700">{{ number_format($totalEntradas, 0, ',', '.') }}</td>
                            <td class="py-2 px-3 text-red-700">{{ number_format($totalSalidas, 0, ',', '.') }}</td>
                            <td class="py-2 px-3 text-black">{{ number_format($ultimoSaldo, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@elseif($libro)
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
        No hay movimientos registrados para este libro contable.
    </div>
@else
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
        No se encontró ningún libro contable para el mes y año seleccionados.
    </div>
@endif

</div>
@endsection