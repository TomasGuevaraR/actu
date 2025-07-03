@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md p-8 max-w-3xl mx-auto">

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Editar Perfil</h2>

        <form method="POST" action="{{ route('mi-perfil.update') }}">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombres</label>
                    <input type="text" name="nombres" value="{{ old('nombres', $usuario->nombres) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" name="apellidos" value="{{ old('apellidos', $usuario->apellidos) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Número de Identificación</label>
                    <input type="text" name="numero_identificacion" value="{{ old('numero_identificacion', $usuario->numero_identificacion) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $usuario->direccion) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Barrio</label>
                    <input type="text" name="barrio" value="{{ old('barrio', $usuario->barrio) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Alias</label>
                    <input type="text" name="alias" value="{{ old('alias', $usuario->alias) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#0166b3] focus:ring-[#0166b3]">
                </div>
            </div>

            {{-- BOTONES --}}
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
