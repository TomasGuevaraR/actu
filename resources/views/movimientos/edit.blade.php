@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-[#0166b3] mb-6 text-center">Editar Movimiento</h2>

        <form action="{{ route('movimientos.update', $movimiento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="fecha" class="block">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="{{ $movimiento->fecha }}" required>
            </div>

            <div class="mb-4">
                <label for="consecutivo" class="block">Consecutivo</label>
                <input type="text" name="consecutivo" class="form-control" value="{{ $movimiento->consecutivo }}">
            </div>

            <div class="mb-4">
                <label for="detalle" class="block">Detalle</label>
                <input type="text" name="detalle" class="form-control" value="{{ $movimiento->detalle }}" required>
            </div>

            <div class="mb-4">
                <label for="concepto" class="block">Concepto</label>
                <input type="text" name="concepto" class="form-control" value="{{ $movimiento->concepto }}" required>
            </div>

            <div class="mb-4">
                <label for="casilla" class="block">Casilla</label>
                <input type="text" name="casilla" class="form-control" value="{{ $movimiento->casilla }}">
            </div>

            <div class="mb-4">
                <label for="valor" class="block">Valor</label>
                <input type="number" name="valor" class="form-control" value="{{ $movimiento->valor }}" required>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('libro.index') }}" class="text-gray-600">← Cancelar</a>
                <button type="submit" class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-6 rounded-full transition">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
