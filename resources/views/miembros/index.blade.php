{{-- resources/views/miembros/index.blade.php --}}
@extends('layouts.app')

@section('content')
@php
    // Toma role o rol, y compara en minúsculas para evitar problemas de mayúsculas
    $rawRole = Auth::user()->role ?? Auth::user()->rol ?? '';
    $rol = is_string($rawRole) ? strtolower($rawRole) : '';
@endphp

{{-- Bloqueo total para Tesorero --}}
@if ($rol === 'tesorero')
<div class="max-w-3xl mx-auto mt-20 p-8 bg-white shadow-md rounded-lg text-center">
    <h2 class="text-2xl font-bold text-red-600">Acceso denegado</h2>
    <p class="text-gray-700 mt-3">No tienes permisos para acceder a esta sección.</p>
    <a href="{{ route('dashboard') }}"
        class="inline-flex items-center mt-6 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-800 transition">
        <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
    </a>
</div>

@else
<div class="max-w-7xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <a href="{{ route('dashboard') }}" 
            class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>

        <h2 class="text-2xl font-bold text-[#0166b3]">Lista de Miembros</h2>

        {{-- Controles por rol --}}
        @if (in_array($rol, ['secretario', 'anciano']))
        {{-- Secretario/Anciano: búsqueda + exportar + crear --}}
        <div class="flex flex-col md:flex-row md:items-center gap-4 w-full md:w-auto">
            <input type="text" id="buscarMiembro" placeholder="Buscar por nombre, apellido o cédula..."
                class="w-full md:w-72 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
            
            <a href="{{ route('miembros.export.csv') }}" 
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 shadow-md">
                📤 Exportar
            </a>

            <a href="{{ route('miembros.create') }}" 
                class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded-full">
                + Crear Miembro
            </a>
        </div>

        @elseif (in_array($rol, ['fiscal', 'pastor', 'filcal']))
        {{-- Fiscal/Pastor: solo búsqueda (ver) --}}
        <div class="flex flex-col md:flex-row md:items-center gap-4 w-full md:w-auto">
            <input type="text" id="buscarMiembro" placeholder="Buscar por nombre, apellido o cédula..."
                class="w-full md:w-72 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>
        @endif
    </div>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de miembros --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded shadow-sm">
            <thead class="bg-[#0166b3] text-white text-sm">
                <tr>
                    <th class="py-2 px-4 border cursor-pointer" onclick="ordenarTabla(0)">Nombres ⬍</th>
                    <th class="py-2 px-4 border cursor-pointer" onclick="ordenarTabla(1)">Apellidos ⬍</th>
                    <th class="py-2 px-4 border cursor-pointer" onclick="ordenarTabla(2)">Identificación ⬍</th>
                    <th class="py-2 px-4 border w-48">Email</th>
                    <th class="py-2 px-4 border">Teléfono</th>
                    <th class="py-2 px-4 border">Nacimiento</th>
                    <th class="py-2 px-4 border">Edad</th>
                    <th class="py-2 px-4 border">Dirección</th>
                    <th class="py-2 px-4 border">Barrio</th>
                    <th class="py-2 px-4 border">Estado</th>
                    @if (in_array($rol, ['secretario', 'anciano']))
                        <th class="py-2 px-4 border text-center">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse ($miembros as $miembro)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border">{{ $miembro->nombres }}</td>
                        <td class="py-2 px-4 border">{{ $miembro->apellidos }}</td>
                        <td class="py-2 px-4 border">{{ $miembro->numero_identificacion }}</td>
                        <td class="py-2 px-4 border max-w-[160px] truncate overflow-hidden whitespace-nowrap" title="{{ $miembro->email }}">
                            {{ $miembro->email }}
                        </td>
                        <td class="py-2 px-4 border">{{ $miembro->telefono }}</td>
                        <td class="py-2 px-4 border">{{ $miembro->fecha_nacimiento }}</td>
                        <td class="py-2 px-4 border">{{ $miembro->edad }}</td>
                        <td class="py-2 px-4 border">{{ $miembro->direccion }}</td>
                        <td class="py-2 px-4 border">{{ $miembro->barrio }}</td>
                        <td class="py-2 px-4 border capitalize">{{ $miembro->estado }}</td>
                        
                        {{-- Acciones solo para Secretario y Ancianos --}}
                        @if (in_array($rol, ['secretario', 'anciano']))
                        <td class="py-2 px-4 border text-center">
                            <a href="{{ route('miembros.edit', $miembro->id) }}" 
                                class="text-blue-600 hover:text-blue-800 mx-1" title="Editar">✏️</a>
                            <button 
                                onclick="abrirModal({{ $miembro->id }})" 
                                class="text-red-600 hover:text-red-800 mx-1" 
                                title="Eliminar">
                                🗑️
                            </button>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ in_array($rol, ['secretario', 'anciano']) ? 11 : 10 }}" 
                            class="text-center py-4 text-gray-500">
                            No hay miembros registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Eliminar (solo visible para Secretario y Ancianos) --}}
@if (in_array($rol, ['secretario', 'anciano']))
<div id="modalEliminar" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold text-[#0166b3] mb-4">Confirmar Eliminación</h2>
        <p class="mb-6">¿Estás seguro de que deseas eliminar este miembro?</p>
        <div class="flex justify-end gap-4">
            <button onclick="cerrarModal()" 
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Cancelar
            </button>
            <form id="formEliminar" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Sí, Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
@endif
@endif {{-- cierre del IF principal (no tesorero) --}}

{{-- Scripts --}}
<script>
    function abrirModal(id) {
        const modal = document.getElementById('modalEliminar');
        const form = document.getElementById('formEliminar');
        form.action = `/miembros/${id}`;
        modal.classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalEliminar').classList.add('hidden');
    }

    // Búsqueda en vivo
    document.getElementById('buscarMiembro')?.addEventListener('input', function () {
        const filtro = this.value.toLowerCase();
        document.querySelectorAll("tbody tr").forEach(fila => {
            fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
        });
    });

    // Ordenar tabla
    function ordenarTabla(columna) {
        const tabla = document.querySelector("table");
        const filas = Array.from(tabla.tBodies[0].rows);

        filas.sort((a, b) => {
            const textoA = a.cells[columna].textContent.trim().toLowerCase();
            const textoB = b.cells[columna].textContent.trim().toLowerCase();
            return textoA.localeCompare(textoB);
        });

        filas.forEach(fila => tabla.tBodies[0].appendChild(fila));
    }
</script>
@endsection
