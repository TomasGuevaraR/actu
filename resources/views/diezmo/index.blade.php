@extends('layouts.app')

@section('content')
@php
    $rolUsuario = Auth::user()->rol ?? '';
@endphp

@if (in_array($rolUsuario, ['tesorero', 'anciano']))
<div class="container py-5">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <a href="{{ route('dashboard') }}" 
            class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
        
        <h2 class="text-2xl font-bold text-[#198754] text-center mb-6">
            Registrar Diezmo y Ofrenda
        </h2>

        <form id="formDiezmo" action="{{ route('diezmo.store') }}" method="POST">
            @csrf

            <!-- Fecha -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" name="fecha" required class="form-control" value="{{ date('Y-m-d') }}" />
            </div>

            <!-- Detalle y concepto -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Detalle</label>
                    <input type="text" name="detalle" class="form-control" placeholder="Ej: Servicio dominical" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Concepto</label>
                    <input type="text" name="concepto" class="form-control" placeholder="Ej: Diezmo y Ofrenda general" required>
                </div>
            </div>

            <!-- Lista de diezmos -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Diezmos</label>
                <div id="diezmoList"></div>
                <button type="button" onclick="agregarDiezmo()" class="mt-2 text-sm text-blue-600 hover:underline">
                    ➕ Agregar persona
                </button>
            </div>

            <!-- Total de diezmos -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Total Diezmos</label>
                <input type="text" id="totalDiezmos" class="form-control bg-gray-100" readonly>
            </div>

            <!-- Ofrenda -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Valor Ofrenda</label>
                <input type="number" name="ofrenda" id="ofrenda" class="form-control" value="0" min="0">
            </div>

            <!-- Total general -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Total General</label>
                <input type="text" id="totalGeneral" class="form-control bg-gray-100" readonly>
            </div>

            <!-- Botón guardar -->
            <div class="text-center">
                <button type="submit"
                    class="bg-[#198754] hover:bg-[#146c43] text-white font-bold py-2 px-6 rounded-full transition">
                    Guardar todo
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Datalist de miembros -->
<datalist id="lista-miembros">
    @foreach($miembros as $miembro)
        <option value="{{ $miembro }}">
    @endforeach
</datalist>

<!-- Scripts -->
<script>
    function agregarDiezmo() {
        const container = document.getElementById('diezmoList');

        const div = document.createElement('div');
        div.classList.add('grid', 'grid-cols-2', 'gap-4', 'mb-2');

        div.innerHTML = `
            <input type="text" name="nombres[]" list="lista-miembros" placeholder="Nombre del miembro" class="form-control" required>
            <input type="number" name="valores[]" placeholder="Valor" class="form-control valor-diezmo" required min="0">
        `;

        container.appendChild(div);
        actualizarTotales();
    }

    document.addEventListener('input', actualizarTotales);

    function actualizarTotales() {
        let totalDiezmos = 0;
        document.querySelectorAll('.valor-diezmo').forEach(el => {
            totalDiezmos += parseInt(el.value) || 0;
        });

        const ofrenda = parseInt(document.getElementById('ofrenda').value) || 0;
        const total = totalDiezmos + ofrenda;

        document.getElementById('totalDiezmos').value = totalDiezmos.toLocaleString();
        document.getElementById('totalGeneral').value = total.toLocaleString();
    }

    window.addEventListener('DOMContentLoaded', agregarDiezmo);
</script>
@else
<div class="container py-5 text-center">
    <h2 class="text-red-600 font-bold">🚫 No tienes permisos para acceder a este módulo.</h2>
</div>
@endif
@endsection
