@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center text-[#0166b3] mb-6">Editar Usuario</h2>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label for="nombre" class="block font-medium text-gray-700">Nombre</label>
            <input name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}" type="text" required
                class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#0166b3]">
        </div>

        <!-- Número de Identificación -->
        <div>
            <label for="numero_identificacion" class="block font-medium text-gray-700">Número de Identificación</label>
            <input name="numero_identificacion" id="numero_identificacion"
                value="{{ old('numero_identificacion', $usuario->numero_identificacion) }}" type="text" required
                class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#0166b3]">
        </div>

        <!-- Correo -->
        <div>
            <label for="email" class="block font-medium text-gray-700">Correo Electrónico</label>
            <input name="email" id="email" value="{{ old('email', $usuario->email) }}" type="email" required
                class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#0166b3]">
        </div>

        <!-- Rol -->
        <div>
            <label for="rol" class="block font-medium text-gray-700">Rol</label>
            <select name="rol" id="rol" required
                class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#0166b3]">
                <option value="Pastor" {{ $usuario->rol == 'Pastor' ? 'selected' : '' }}>Pastor</option>
                <option value="Anciano" {{ $usuario->rol == 'Anciano' ? 'selected' : '' }}>Anciano</option>
                <option value="Fiscal" {{ $usuario->rol == 'Fiscal' ? 'selected' : '' }}>Fiscal</option>
                <option value="Tesorero" {{ $usuario->rol == 'Tesorero' ? 'selected' : '' }}>Tesorero</option>
                <option value="Secretario" {{ $usuario->rol == 'Secretario' ? 'selected' : '' }}>Secretario</option>
            </select>
        </div>

        <!-- Cambiar contraseña (opcional) -->
        <div>
            <label for="password" class="block font-medium text-gray-700">Nueva Contraseña (opcional)</label>
            <input name="password" id="password" type="password"
                class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-2 focus:ring-[#0166b3]">
            <p class="text-sm text-gray-500">Dejar en blanco si no deseas cambiar la contraseña</p>
        </div>

        <div class="text-center">
            <button type="submit"
                class="bg-[#0166b3] hover:bg-[#014a82] text-white font-semibold py-2 px-6 rounded transition duration-200">
                Actualizar Usuario
            </button>
        </div>
    </form>
</div>
@endsection
