@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    {{-- Título y botón de crear --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Gestión de Usuarios</h2>
        <a href="{{ route('usuarios.create') }}"
            class="bg-[#0166b3] hover:bg-[#014a82] text-white font-semibold py-2 px-4 rounded shadow">
            + Crear Usuario
        </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de usuarios --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#0166b3] text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Rol</th>
                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Estado</th>
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                @foreach ($usuarios as $usuario)
                <tr>
                    <td class="px-6 py-4">{{ $usuario->nombre }}</td>
                    <td class="px-6 py-4">{{ $usuario->email }}</td>
                    <td class="px-6 py-4">{{ ucfirst($usuario->rol) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $usuario->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($usuario->estado) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        {{-- Editar --}}
                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                            class="text-blue-600 hover:text-blue-900 font-medium">
                            Editar
                        </a>

                        {{-- Activar / Desactivar --}}
                        <form action="{{ route('usuarios.toggle', $usuario->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="text-sm font-medium {{ $usuario->estado === 'activo' ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }}"
                                onclick="return confirm('¿Está seguro de cambiar el estado de este usuario?');">
                                {{ $usuario->estado === 'activo' ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
