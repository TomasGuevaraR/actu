@extends('layouts.app')

@section('content')
@php
    $rolUsuario = Auth::user()->rol ?? ''; 
@endphp

@if ($rolUsuario === 'secretario')
    <div class="container py-5">
        <div class="text-center text-red-600 text-lg font-bold">
            🚫 No tienes permisos para acceder al Libro Contable.
        </div>
    </div>
@else
<div class="container py-5 text-sm">

    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4 px-4 pt-4">
        <div class="flex justify-start">
            <a href="{{ route('dashboard') }}" 
                class="inline-flex items-center px-3 py-1.5 bg-[#0166b3] text-white text-xs font-medium rounded hover:bg-[#014c86] transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver
            </a>
        </div>

        <h1 class="text-xl font-bold text-[#0166b3]">
            <i class="bi bi-journal-text me-2"></i> Libro Contable
            @if(isset($libroActual))
                <span class="ml-2 text-gray-700 text-base font-medium">
                    ({{ $libroActual->nombre }})
                </span>
            @endif
        </h1>

        <!-- Estado actual del libro -->
        @if(isset($libroActual))
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                @if($libroActual->estado === 'activo') bg-green-100 text-green-800
                @elseif($libroActual->estado === 'cerrado') bg-yellow-100 text-yellow-800
                @elseif($libroActual->estado === 'aprobado') bg-blue-100 text-blue-800
                @else bg-gray-100 text-gray-800
                @endif">
                Estado: {{ ucfirst($libroActual->estado) }}
            </span>
        @endif

        <!-- Botones solo para tesorero -->
        @if ($rolUsuario === 'tesorero')
            <div class="flex flex-col md:flex-row md:items-center gap-3 w-full md:w-auto mt-2 md:mt-0">
                <a href="{{ route('ingresos.create') }}"
                    class="bg-[#0d6efd] hover:bg-[#014a82] text-white font-bold py-1.5 px-3 rounded-full transition duration-300 shadow-md text-xs">
                    ➕ Ingreso
                </a>
                <a href="{{ route('egresos.create') }}"
                    class="bg-[#dc3545] hover:bg-[#a71d2a] text-white font-bold py-1.5 px-3 rounded-full transition duration-300 shadow-md text-xs">
                    ➖ Egreso
                </a>
            </div>
        @endif
    </div>

    <!-- Tabla de movimientos -->
    @if(isset($libroActual))
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
                            <th class="py-2 px-3 border">Ver</th>
                            @if ($rolUsuario === 'tesorero')
                                <th class="py-2 px-3 border">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-xs text-gray-700">
                        @php
                            $totalEntradas = 0;
                            $totalSalidas = 0;
                            $ultimoSaldo = 0;
                        @endphp

                        @forelse ($movimientos as $mov)
                            @php
                                $entrada = $mov->tipo === 'ingreso' ? (float) $mov->valor : 0;
                                $salida  = $mov->tipo === 'egreso' ? (float) $mov->valor : 0;
                                $valorMostrar = $mov->valor ?? 0;
                                $totalEntradas += $entrada;
                                $totalSalidas  += $salida;
                                $ultimoSaldo   = $mov->saldo ?? $ultimoSaldo;
                            @endphp
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-3 border">{{ $mov->fecha }}</td>
                                <td class="py-2 px-3 border">{{ $mov->consecutivo ?? '-' }}</td>
                                <td class="py-2 px-3 border">{{ $mov->detalle }}</td>
                                <td class="py-2 px-3 border">{{ $mov->concepto }}</td>
                                <td class="py-2 px-3 border">{{ $mov->casilla ?? '-' }}</td>
                                <td class="py-2 px-3 border">{{ number_format($valorMostrar, 0, ',', '.') }}</td>
                                <td class="py-2 px-3 border text-green-600 font-semibold">
                                    {{ $entrada > 0 ? number_format($entrada, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-2 px-3 border text-red-600 font-semibold">
                                    {{ $salida > 0 ? number_format($salida, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-2 px-3 border font-semibold">
                                    {{ number_format($mov->saldo ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="py-2 px-3 border text-center">
                                    <button class="text-indigo-600 hover:text-indigo-800 text-sm" 
                                            onclick="mostrarDetalles({{ $mov->id }})"
                                            title="Ver detalles">
                                        🔍
                                    </button>
                                </td>
                                @if ($rolUsuario === 'tesorero')
                                    <td class="py-2 px-3 border text-center">
                                        <a href="{{ route('movimientos.edit', $mov->id) }}" class="text-blue-600 hover:text-blue-800 mx-1 text-sm" title="Editar">✏️</a>
                                        <button type="button" 
                                                class="text-red-600 hover:text-red-800 mx-1 text-sm" 
                                                title="Eliminar"
                                                onclick="abrirModalEliminar('{{ route('movimientos.destroy', $mov->id) }}')">🗑️</button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $rolUsuario === 'tesorero' ? 11 : 10 }}" class="text-center py-4 text-gray-500">No hay movimientos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-100 text-xs font-semibold">
                        <tr>
                            <td colspan="6" class="py-2 px-3 text-right">Totales:</td>
                            <td class="py-2 px-3 text-green-700">{{ number_format($totalEntradas, 0, ',', '.') }}</td>
                            <td class="py-2 px-3 text-red-700">{{ number_format($totalSalidas, 0, ',', '.') }}</td>
                            <td class="py-2 px-3 text-black">{{ number_format($ultimoSaldo ?? 0, 0, ',', '.') }}</td>
                            <td colspan="{{ $rolUsuario === 'tesorero' ? 2 : 1 }}"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
            No se encontró ningún libro contable activo.
        </div>
    @endif
</div>
@endif

<!-- Modales -->

<!-- Modal Ingreso -->
<div id="modalIngreso" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-4 w-[650px] max-h-[85vh] overflow-y-auto text-xs">
        <h2 class="text-base font-bold text-green-600 mb-3">💰 Detalles de Ingreso</h2>
        <div id="listaIngreso" class="grid grid-cols-3 gap-2"></div>
        <div id="totalIngreso" class="mt-3 text-right font-bold text-green-600"></div>
        <div class="mt-3 flex justify-end">
            <button onclick="cerrarModal('modalIngreso')" class="bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 text-xs">Cerrar</button>
        </div>
    </div>
</div>

<!-- Modal Egreso -->
<div id="modalEgreso" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-4 w-[650px] max-h-[85vh] overflow-y-auto text-xs">
        <h2 class="text-base font-bold text-red-600 mb-3">📤 Detalles de Egreso</h2>
        <div id="listaEgreso" class="grid grid-cols-3 gap-2"></div>
        <div id="totalEgreso" class="mt-3 text-right font-bold text-red-600"></div>
        <div class="mt-3 flex justify-end">
            <button onclick="cerrarModal('modalEgreso')" class="bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 text-xs">Cerrar</button>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="modalEliminar" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-4 w-80 text-center text-sm">
        <h2 class="text-lg font-bold text-red-600 mb-3">⚠️ Confirmar eliminación</h2>
        <p class="mb-4">¿Seguro que deseas eliminar este registro?</p>
        <form id="formEliminar" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex justify-center gap-3">
                <button type="button" onclick="cerrarModalEliminar()" class="bg-gray-400 text-white px-3 py-1.5 rounded hover:bg-gray-500 text-xs">Cancelar</button>
                <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 text-xs">Eliminar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Éxito -->
@if(session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 2000)" 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
    >
        <div class="bg-white rounded-lg shadow-lg p-4 max-w-sm text-center border border-blue-400 text-xs">
            <div class="flex flex-col items-center">
                <svg class="w-10 h-10 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M5 13l4 4L19 7" />
                </svg>
                <h2 class="text-base font-semibold text-blue-600 mb-1">¡Éxito!</h2>
                <p class="text-gray-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<script>
    async function mostrarDetalles(id) {
        const response = await fetch(`/movimientos/${id}/detalles`);
        const data = await response.json();

        const tipo = data.tipo; 
        const detalles = data.detalles;

        if (tipo === 'ingreso') {
            llenarModal(detalles, 'listaIngreso', 'totalIngreso');
            document.getElementById('modalIngreso').classList.remove('hidden');
        } else {
            llenarModal(detalles, 'listaEgreso', 'totalEgreso');
            document.getElementById('modalEgreso').classList.remove('hidden');
        }
    }

    function llenarModal(detalles, listaId, totalId) {
        const lista = document.getElementById(listaId);
        const totalDiv = document.getElementById(totalId);
        lista.innerHTML = "";
        totalDiv.textContent = "";

        let total = 0;

        if (detalles.length > 0) {
            detalles.forEach((item) => {
                const div = document.createElement("div");
                div.className = "p-2 border rounded bg-gray-50 text-xs";
                const label = item.nombre ? item.nombre : (item.casilla ?? 'N/A');
                div.textContent = `${label} → $${new Intl.NumberFormat("es-CO").format(item.valor)}`;
                lista.appendChild(div);
                total += item.valor;
            });
            totalDiv.textContent = `Total: $${new Intl.NumberFormat("es-CO").format(total)}`;
        } else {
            const div = document.createElement("div");
            div.textContent = "No hay registros asociados.";
            lista.appendChild(div);
        }
    }

    function cerrarModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function abrirModalEliminar(url) {
        document.getElementById('formEliminar').action = url;
        document.getElementById('modalEliminar').classList.remove('hidden');
    }
    function cerrarModalEliminar() {
        document.getElementById('modalEliminar').classList.add('hidden');
    }
</script>

@endsection
