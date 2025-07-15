@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-[#198754] text-center mb-6">Registrar Diezmo y Ofrenda</h2>

        <form id="formDiezmo" action="{{ route('diezmos.store') }}" method="POST">
            @csrf

            <!-- Fecha -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" name="fecha" required class="form-control" />
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
                <div id="diezmoList">
                    <!-- Aquí se agregarán los campos dinámicamente -->
                </div>
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

<!-- Scripts para lógica dinámica -->
<script>
    let index = 0;

    function agregarDiezmo() {
        const container = document.getElementById('diezmoList');

        const div = document.createElement('div');
        div.classList.add('grid', 'grid-cols-2', 'gap-4', 'mb-2');

        div.innerHTML = `
            <input type="text" name="nombres[]" placeholder="Nombre" class="form-control" required>
            <input type="number" name="valores[]" placeholder="Valor" class="form-control valor-diezmo" required min="0">
        `;

        container.appendChild(div);
        actualizarTotales();
    }

    document.addEventListener('input', function () {
        actualizarTotales();
    });

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
</script>
@endsection
