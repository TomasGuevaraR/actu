@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Botón Volver -->
    <div class="mb-4 ml-[1cm]">
        <a href="{{ route('libro.index') }}"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full transition">
            ← Volver al Libro Contable
        </a>
    </div>

    <!-- Formulario -->
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-[#0166b3] mb-6 text-center">Registrar Ingreso</h2>

        <form id="formIngreso" action="{{ route('ingresos.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del Ingreso</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>

                <div>
                    <label for="consecutivo" class="block text-sm font-medium text-gray-700">Consecutivo</label>
                    <input type="text" name="consecutivo" id="consecutivo" class="form-control" placeholder="Número de comprobante" required>
                </div>

                <div>
                    <label for="detalle" class="block text-sm font-medium text-gray-700">Recibido de...</label>
                    <input type="text" name="detalle" id="detalle" class="form-control" placeholder="Ej: Donación, venta, etc." required>
                </div>

                <div>
                    <label for="concepto" class="block text-sm font-medium text-gray-700">Concepto</label>
                    <input type="text" name="concepto" id="concepto" class="form-control" placeholder="Ej: Ingreso general, evento especial" required>
                </div>

                <div>
                    <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input type="number" name="valor" id="valor" class="form-control" placeholder="Ej: 50000" required>
                </div>
            </div>

            <input type="hidden" name="tipo" value="ingreso">

            <!-- Botón Guardar -->
            <div class="text-center mt-8">
                <button type="button" onclick="abrirModal()"
                    class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-6 rounded-full transition">
                    Guardar Ingreso
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Personalizado (Tailwind) -->
<div id="modalIngreso" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4 text-[#0166b3]">¿Confirmar Registro?</h3>
        <p class="text-gray-700 mb-6">¿Estás seguro de que deseas registrar este ingreso?</p>
        <div class="flex justify-end gap-4">
            <button onclick="cerrarModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Cancelar</button>
            <button onclick="document.getElementById('formIngreso').submit()"
                class="px-4 py-2 bg-[#0166b3] text-white rounded hover:bg-[#014a82] transition">
                Sí, Guardar
            </button>
        </div>
    </div>
</div>

<!-- Script para el modal -->
<script>
    function abrirModal() {
        document.getElementById('modalIngreso').classList.remove('hidden');
        document.getElementById('modalIngreso').classList.add('flex');
    }

    function cerrarModal() {
        document.getElementById('modalIngreso').classList.add('hidden');
    }
</script>
@endsection
