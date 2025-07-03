@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md p-8 max-w-3xl mx-auto text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Mi Perfil</h2>

        {{-- DATOS DEL USUARIO --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-left">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                <p class="mt-1 text-gray-900">{{ $usuario->nombre }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <p class="mt-1 text-gray-900">{{ $usuario->rol }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-gray-900">{{ $usuario->email }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Número de Identificación</label>
                <p class="mt-1 text-gray-900">{{ $usuario->numero_identificacion }}</p>
            </div>
        </div>

        <hr class="my-6">

        {{-- DATOS DEL MIEMBRO (si existe) --}}
        @if ($miembro)
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Datos personales desde miembros</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-left">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombres</label>
                <p class="mt-1 text-gray-900">{{ $miembro->nombres }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Apellidos</label>
                <p class="mt-1 text-gray-900">{{ $miembro->apellidos }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <p class="mt-1 text-gray-900">{{ $miembro->telefono }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                <p class="mt-1 text-gray-900">{{ $miembro->direccion }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Barrio</label>
                <p class="mt-1 text-gray-900">{{ $miembro->barrio }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
                <p class="mt-1 text-gray-900">{{ $miembro->fecha_nacimiento }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Edad</label>
                <p class="mt-1 text-gray-900">{{ $miembro->edad }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <p class="mt-1 text-gray-900">{{ $miembro->estado }}</p>
            </div>
        </div>
        @else
        <p class="text-red-600 mt-6">No se encontró información del miembro con ese número de identificación.</p>
        @endif

        {{-- BOTÓN EDITAR --}}
        <a href="{{ route('mi-perfil.edit') }}"
            class="bg-[#0166b3] hover:bg-[#014a82] text-white py-2 px-6 rounded-full shadow inline-block mt-6">
            Editar perfil
        </a>
    </div>
</div>
@endsection
