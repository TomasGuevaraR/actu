{{-- resources/views/miembros/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
    <h2 class="text-2xl font-bold text-[#0166b3] mb-6">Editar Miembro</h2>

    <form id="formulario-edicion" action="{{ route('miembros.update', $miembro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-bold text-red-600">Nombres *</label>
                <input type="text" name="nombres" value="{{ old('nombres', $miembro->nombres) }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-bold text-red-600">Apellidos *</label>
                <input type="text" name="apellidos" value="{{ old('apellidos', $miembro->apellidos) }}" class="w-full border rounded p-2" required>
            </div>

            <div class="col-span-2">
                <label class="font-bold text-red-600">Número de Identificación *</label>
                <input type="text" name="numero_identificacion" value="{{ old('numero_identificacion', $miembro->numero_identificacion) }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $miembro->email) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label>Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $miembro->telefono) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label>Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $miembro->fecha_nacimiento) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label>Edad</label>
                <input type="number" name="edad" value="{{ old('edad', $miembro->edad) }}" class="w-full border rounded p-2">
            </div>

            <div class="col-span-2">
                <label>Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $miembro->direccion) }}" class="w-full border rounded p-2">
            </div>

            <div class="col-span-2">
                <label>Barrio</label>
                <input type="text" name="barrio" value="{{ old('barrio', $miembro->barrio) }}" class="w-full border rounded p-2">
            </div>

            <div class="col-span-2">
                <label>Estado</label>
                <select name="estado" class="w-full border rounded p-2">
                    <option value="activo" {{ $miembro->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $miembro->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    <option value="borrado" {{ $miembro->estado == 'borrado' ? 'selected' : '' }}>Borrado</option>
                    <option value="con excusa permanente" {{ $miembro->estado == 'con excusa permanente' ? 'selected' : '' }}>Con excusa permanente</option>
                    <option value="ausente" {{ $miembro->estado == 'ausente' ? 'selected' : '' }}>Ausente</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded-full">
                Actualizar Miembro
            </button>
        </div>
    </form>
</div>

<!-- Modal de Confirmación -->
<div id="modalConfirmacion" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-[#0166b3]">Confirmar Actualización</h2>
        <p class="mb-6">¿Estás seguro de que deseas actualizar este miembro?</p>
        <div class="flex justify-end space-x-4">
            <button id="cancelarModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Cancelar
            </button>
            <button id="confirmarModal" class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded">
                Sí, actualizar
            </button>
        </div>
    </div>
</div>

<!-- Script para manejar el modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formulario = document.getElementById('formulario-edicion');
        const modal = document.getElementById('modalConfirmacion');
        const confirmarBtn = document.getElementById('confirmarModal');
        const cancelarBtn = document.getElementById('cancelarModal');

        formulario.addEventListener('submit', function (e) {
            e.preventDefault(); // Detiene el envío por defecto
            modal.classList.remove('hidden'); // Muestra el modal
        });

        confirmarBtn.addEventListener('click', function () {
            modal.classList.add('hidden'); // Oculta el modal
            formulario.submit(); // Envía el formulario
        });

        cancelarBtn.addEventListener('click', function () {
            modal.classList.add('hidden'); // Cierra el modal sin enviar
        });
    });
</script>
@endsection
