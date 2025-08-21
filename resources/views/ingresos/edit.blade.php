@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Editar Ingreso</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Importante: enviamos al update de movimientos y cumplimos con los arrays requeridos --}}
        <form action="{{ route('movimientos.update', $movimiento->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Fecha --}}
            <div>
                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input
                    type="date"
                    id="fecha"
                    name="fecha"
                    value="{{ old('fecha', \Carbon\Carbon::parse($movimiento->fecha)->format('Y-m-d')) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
            </div>

            {{-- Consecutivo (opcional) --}}
            <div>
                <label for="consecutivo" class="block text-sm font-medium text-gray-700">Consecutivo (opcional)</label>
                <input
                    type="text"
                    id="consecutivo"
                    name="consecutivo"
                    value="{{ old('consecutivo', $movimiento->consecutivo) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>

            {{-- Detalle --}}
            <div>
                <label for="detalle" class="block text-sm font-medium text-gray-700">Detalle</label>
                <input
                    type="text"
                    id="detalle"
                    name="detalle"
                    value="{{ old('detalle', $movimiento->detalle) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
            </div>

            {{-- Concepto --}}
            <div>
                <label for="concepto" class="block text-sm font-medium text-gray-700">Concepto</label>
                <input
                    type="text"
                    id="concepto"
                    name="concepto"
                    value="{{ old('concepto', $movimiento->concepto) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
            </div>

            {{-- ===== Campos requeridos por MovimientoController@update (arrays) ===== --}}
            <input type="hidden" name="movimiento_id[]" value="{{ $movimiento->id }}">
            <input type="hidden" name="presupuesto_id[]" value=""> {{-- null para ingresos --}}

            {{-- Valor (monto del ingreso) --}}
            <div>
                <label for="valor" class="block text-sm font-medium text-gray-700">Monto</label>
                <input
                    type="number"
                    step="0.01"
                    id="valor"
                    name="valor[]"
                    value="{{ old('valor.0', $movimiento->valor) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
            </div>
            {{-- ===================================================================== --}}

            <div class="flex justify-between pt-2">
                <a href="{{ route('libro.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-800">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
