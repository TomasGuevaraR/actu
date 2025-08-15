@extends('layouts.app')

@section('content')
@php
    $rolUsuario = Auth::user()->rol ?? ''; // Cambia 'rol' si tu campo se llama diferente
@endphp

@if ($rolUsuario === 'secretario')
    <div class="container py-5">
        <div class="text-center text-red-600 text-xl font-bold">
            🚫 No tienes permisos para acceder al Libro Contable.
        </div>
    </div>
@else
<div class="container py-5">
    
    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4 px-4 pt-4">
        <div class="flex justify-start">
            <a href="{{ route('dashboard') }}" 
                class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver
            </a>
        </div>
        <h1 class="text-2xl font-bold text-[#0166b3]">
            <i class="bi bi-journal-text me-2"></i> Libro Contable
        </h1>

        <!-- Botones solo para tesorero -->
        @if ($rolUsuario === 'tesorero')
            <div class="flex flex-col md:flex-row md:items-center gap-4 w-full md:w-auto">
                <a href="{{ route('ingresos.create') }}"
                    class="bg-[#0d6efd] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded-full transition duration-300 shadow-md">
                    ➕ Ingreso
                </a>
                <a href="{{ route('egresos.create') }}"
                    class="bg-[#dc3545] hover:bg-[#a71d2a] text-white font-bold py-2 px-4 rounded-full transition duration-300 shadow-md">
                    ➖ Egreso
                </a>
            </div>
        @endif
    </div>

    <!-- Tabla -->
    <div class="card-body px-4 py-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded shadow-sm">
                <thead class="bg-[#0166b3] text-white text-sm">
                    <tr>
                        <th class="py-2 px-4 border">Fecha</th>
                        <th class="py-2 px-4 border">Consecutivo</th>
                        <th class="py-2 px-4 border">Detalle</th>
                        <th class="py-2 px-4 border">Concepto</th>
                        <th class="py-2 px-4 border">Casilla</th>
                        <th class="py-2 px-4 border">Valor</th>
                        <th class="py-2 px-4 border">Entrada</th>
                        <th class="py-2 px-4 border">Salida</th>
                        <th class="py-2 px-4 border">Saldo</th>
                        @if ($rolUsuario === 'tesorero')
                            <th class="py-2 px-4 border">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @php
                        $totalEntradas = 0;
                        $totalSalidas = 0;
                        $ultimoSaldo = 0;
                    @endphp

                    @forelse ($movimientos as $mov)
                        @php
                            if ($mov->tipo === 'ingreso') {
                                $totalEntradas += $mov->valor;
                            } elseif ($mov->tipo === 'egreso') {
                                $totalSalidas += $mov->valor;
                            }
                            $ultimoSaldo = $mov->saldo_actual ?? $ultimoSaldo;
                        @endphp
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border">{{ $mov->fecha }}</td>
                            <td class="py-2 px-4 border">{{ $mov->consecutivo ?? '-' }}</td>
                            <td class="py-2 px-4 border">{{ $mov->detalle }}</td>
                            <td class="py-2 px-4 border">{{ $mov->concepto }}</td>
                            <td class="py-2 px-4 border">{{ $mov->casilla ?? '-' }}</td>
                            <td class="py-2 px-4 border">{{ number_format($mov->valor, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border text-green-600 fw-semibold">
                                {{ $mov->tipo === 'ingreso' ? number_format($mov->valor, 0, ',', '.') : '-' }}
                            </td>
                            <td class="py-2 px-4 border text-red-600 fw-semibold">
                                {{ $mov->tipo === 'egreso' ? number_format($mov->valor, 0, ',', '.') : '-' }}
                            </td>
                            <td class="py-2 px-4 border fw-semibold">
                                {{ number_format($mov->saldo_actual ?? 0, 0, ',', '.') }}
                            </td>
                            
                            @if ($rolUsuario === 'tesorero')
                                <td class="py-2 px-4 border text-center">
                                    <a href="{{ route('movimientos.edit', $mov->id) }}" class="text-blue-600 hover:text-blue-800 mx-1" title="Editar">
                                        ✏️
                                    </a>
                                    <form action="{{ route('movimientos.destroy', $mov->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar este movimiento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 mx-1" title="Eliminar">🗑️</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $rolUsuario === 'tesorero' ? 10 : 9 }}" class="text-center py-4 text-gray-500">No hay movimientos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>

                <!-- Fila total -->
                <tfoot class="bg-gray-100 text-sm font-semibold">
                    <tr>
                        <td colspan="6" class="py-2 px-4 text-right">Totales:</td>
                        <td class="py-2 px-4 text-green-700">{{ number_format($totalEntradas, 0, ',', '.') }}</td>
                        <td class="py-2 px-4 text-red-700">{{ number_format($totalSalidas, 0, ',', '.') }}</td>
                        <td class="py-2 px-4 text-black">{{ number_format($saldoFinal, 0, ',', '.') }}</td>
                        @if ($rolUsuario === 'tesorero')
                            <td class="py-2 px-4">—</td>
                        @endif
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
@endif
@endsection

@if (session('success'))
    <div 
        class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate__animated animate__fadeInDown z-50" 
        id="toast"
    >
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.classList.add('animate__fadeOutUp');
                setTimeout(() => toast.remove(), 1000);
            }
        }, 3000);
    </script>
@endif
