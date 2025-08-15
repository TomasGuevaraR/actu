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
        <h2 class="text-2xl font-bold text-[#dc3545] mb-6 text-center">Registrar Egreso</h2>

        <form id="formEgreso" action="{{ route('egresos.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Fecha -->
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del Egreso</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>

                <!-- Consecutivo -->
                <div>
                    <label for="consecutivo" class="block text-sm font-medium text-gray-700">Consecutivo</label>
                    <input type="text" name="consecutivo" id="consecutivo" class="form-control" placeholder="Ej: EGR-0001" required>
                </div>

                <!-- Detalle -->
                <div>
                    <label for="detalle" class="block text-sm font-medium text-gray-700">Pagado a..</label>
                    <input type="text" name="detalle" id="detalle" class="form-control" placeholder="Ej: Pago de servicios" required>
                </div>

                <!-- Concepto -->
                <div>
                    <label for="concepto" class="block text-sm font-medium text-gray-700">Concepto</label>
                    <input type="text" name="concepto" id="concepto" class="form-control" placeholder="Ej: Luz, agua, mantenimiento" required>
                </div>
            </div>

            <!-- Casillas -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Casillas y valores</label>
                
                <div id="casillasContainer">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                        <select name="presupuesto_id[]" class="form-control" required>
                            <option value="">Seleccione una casilla</option>
                            @foreach ($casillas as $casilla)
                                <option value="{{ $casilla->id }}">{{ $casilla->nombre_casilla }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="valor[]" class="form-control" placeholder="Valor" required>
                    </div>
                </div>

                <button type="button" onclick="agregarCasilla()" 
                    class="mt-2 bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
                    ➕ Agregar otra casilla
                </button>
            </div>

            <!-- Total -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Total</label>
                <input type="text" id="total" class="form-control bg-gray-100 font-bold" readonly>
            </div>

            <input type="hidden" name="tipo" value="egreso">

            <!-- Botón Guardar -->
            <div class="text-center mt-8">
                <button type="button"
                        class="bg-[#dc3545] hover:bg-[#a71d2a] text-white font-bold py-2 px-6 rounded-full transition"
                        onclick="confirmarEnvio()">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div id="modalGuardar" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center">
        <h2 class="text-lg font-bold text-gray-800 mb-4">¿Deseas guardar este egreso?</h2>
        <div class="flex justify-center gap-4">
            <button onclick="cerrarModal()" class="px-4 py-2 rounded bg-gray-500 hover:bg-gray-600 text-white">
                Cancelar
            </button>
            <button onclick="document.getElementById('formEgreso').submit();" class="px-4 py-2 rounded bg-[#dc3545] hover:bg-[#a71d2a] text-white">
                Sí, Guardar
            </button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function confirmarEnvio() {
        document.getElementById('modalGuardar').classList.remove('hidden');
        document.getElementById('modalGuardar').classList.add('flex');
    }

    function cerrarModal() {
        document.getElementById('modalGuardar').classList.add('hidden');
        document.getElementById('modalGuardar').classList.remove('flex');
    }

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('input[name="valor[]"]').forEach(input => {
            let val = parseFloat(input.value) || 0;
            total += val;
        });
        document.getElementById('total').value = total.toFixed(2);
    }

    document.addEventListener('input', function(e) {
        if (e.target && e.target.name === 'valor[]') {
            calcularTotal();
        }
    });

    function agregarCasilla() {
        const container = document.getElementById('casillasContainer');
        const nuevo = document.createElement('div');
        nuevo.classList.add('grid', 'grid-cols-1', 'md:grid-cols-2', 'gap-4', 'mb-2');
        nuevo.innerHTML = `
            <select name="presupuesto_id[]" class="form-control" required>
                <option value="">Seleccione una casilla</option>
                @foreach ($casillas as $casilla)
                    <option value="{{ $casilla->id }}">{{ $casilla->nombre_casilla }}</option>
                @endforeach
            </select>
            <input type="number" name="valor[]" class="form-control" placeholder="Valor" required>
        `;
        container.appendChild(nuevo);
    }

    window.onload = calcularTotal;
</script>
@endsection
