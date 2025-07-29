@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md p-8 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Editar Perfil</h2>

        <form method="POST" action="{{ route('mi-perfil.update') }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- DATOS DE USUARIO --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Rol</label>
                    <input type="text" name="rol" value="{{ $usuario->rol }}" readonly
                        class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Número de Identificación</label>
                    <input type="text" name="numero_identificacion" value="{{ old('numero_identificacion', $usuario->numero_identificacion) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- DATOS DE MIEMBRO --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombres</label>
                    <input type="text" name="nombres" value="{{ old('nombres', $miembro->nombres ?? '') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" name="apellidos" value="{{ old('apellidos', $miembro->apellidos ?? '') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $miembro->telefono ?? '') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $miembro->fecha_nacimiento ?? '') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Edad</label>
                    <input type="text" value="{{ $miembro->edad }}" readonly
                        class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $miembro->direccion ?? '') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Barrio</label>
                    <input type="text" name="barrio" value="{{ old('barrio', $miembro->barrio ?? '') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <input type="text" value="{{ $miembro->estado }}" readonly
                        class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                    <input type="hidden" name="estado" value="{{ $miembro->estado }}">
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('mi-perfil.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-6 rounded-full shadow">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-[#0166b3] hover:bg-[#014a82] text-white py-2 px-6 rounded-full shadow">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
