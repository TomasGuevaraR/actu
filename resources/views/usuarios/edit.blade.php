@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Editar Usuario</h2>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <input name="nombres" value="{{ $usuario->nombres }}" type="text" required class="w-full p-2 border rounded">
        <input name="apellidos" value="{{ $usuario->apellidos }}" type="text" required class="w-full p-2 border rounded">
        <input name="email" value="{{ $usuario->email }}" type="email" required class="w-full p-2 border rounded">
        <input name="rol" value="{{ $usuario->rol }}" type="text" required class="w-full p-2 border rounded">
        <button class="bg-[#0166b3] text-white py-2 px-4 rounded hover:bg-[#014a82]">Actualizar</button>
    </form>
</div>
@endsection
