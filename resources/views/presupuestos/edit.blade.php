@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="max-w-3xl mx-auto mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <strong class="font-bold">✅ ¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif

<div class="container py-4 flex justify-center">
    <div class="w-full max-w-3xl">
        <div class="bg-white shadow-lg rounded-lg p-8">

            {{-- Encabezado --}}
            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('presupuestos.index') }}" 
                    class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
                    <i class="fas fa-arrow-left mr-2"></i> Volver
                </a>
                <h2 class="text-2xl font-bold text-[#0166b3] text-center flex-1">✏️ Editar Presupuesto</h2>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('presupuestos.update', $presupuesto->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nombre de Casilla --}}
                <div class="flex flex-col items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de Casilla</label>
                    <input type="text" name="nombre_casilla" value="{{ old('nombre_casilla', $presupuesto->nombre_casilla) }}" 
                        required class="border rounded-md px-3 py-2 w-60 text-base">
                </div>

                {{-- Categoría --}}
                <div class="flex flex-col items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                    <input type="text" name="categoria" value="{{ old('categoria', $presupuesto->categoria) }}" 
                        required class="border rounded-md px-3 py-2 w-60 text-base">
                </div>

                {{-- Valor Mensual --}}
                <div class="flex flex-col items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Valor Mensual</label>
                    <input type="number" name="valor_mensual" value="{{ old('valor_mensual', $presupuesto->valor_mensual) }}" 
                        min="0" step="0.01" required class="border rounded-md px-3 py-2 w-60 text-base">
                </div>

                {{-- Año --}}
                <div class="flex flex-col items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
                    <input type="number" name="año" value="{{ old('año', $presupuesto->año) }}" 
                        min="2024" required class="border rounded-md px-3 py-2 w-60 text-base">
                </div>

                {{-- Responsable --}}
                <div class="flex flex-col items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                    <input type="text" name="responsable" value="{{ old('responsable', $presupuesto->responsable) }}" 
                        class="border rounded-md px-3 py-2 w-60 text-base">
                </div>

                {{-- Botones --}}
                <div class="flex justify-center gap-3 mt-6">
                    <a href="{{ route('presupuestos.index') }}" class="px-4 py-2 bg-gray-400 text-white text-sm rounded hover:bg-gray-500">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-[#0166b3] text-white text-sm rounded hover:bg-[#014c86]">
                        💾 Guardar Cambios
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
