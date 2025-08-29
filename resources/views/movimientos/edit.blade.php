@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-[#0166b3] mb-6 text-center">Editar Egreso</h2>

        <form action="{{ route('movimientos.update', $movimiento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Datos generales -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="fecha" class="block">Fecha</label>
                    <input type="date" name="fecha" class="form-control"
                        value="{{ old('fecha', $movimiento->fecha) }}" required>
                </div>

                <div>
                    <label for="consecutivo" class="block">Consecutivo</label>
                    <input type="text" name="consecutivo" class="form-control"
                        value="{{ old('consecutivo', $movimiento->consecutivo) }}">
                </div>
            </div>

            <div class="mb-4">
                <label for="detalle" class="block">Detalle</label>
                <input type="text" name="detalle" class="form-control"
                    value="{{ old('detalle', $movimiento->detalle) }}" required>
            </div>

            <div class="mb-4">
                <label for="concepto" class="block">Concepto</label>
                <input type="text" name="concepto" class="form-control"
                    value="{{ old('concepto', $movimiento->concepto) }}" required>
            </div>

            <!-- Movimientos del grupo -->
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Casillas y valores</h3>
            <div id="casillas-container">
                @foreach($movimientos as $index => $mov)
                    <div class="grid grid-cols-2 gap-4 mb-3 border p-3 rounded-md bg-gray-50">
                        <!-- id del movimiento para mapear exacto en el update -->
                        <input type="hidden" name="movimiento_id[]" value="{{ $mov->id }}">

                        <div>
                            <label>Casilla</label>
                            <select name="presupuesto_id[]" class="form-control" required>
                                <option value="">Seleccione...</option>
                                @foreach($casillas as $casilla)
                                    <option value="{{ $casilla->id }}"
                                        {{ $mov->presupuesto_id == $casilla->id ? 'selected' : '' }}>
                                        {{ $casilla->nombre_casilla }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label>Valor</label>
                            <input type="number" step="0.01" name="valor[]" class="form-control"
                                value="{{ old('valor.' . $index, number_format($mov->valor, 2, '.', '')) }}" required>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('libro.index') }}" class="text-gray-600">← Cancelar</a>
                <button type="submit"
                    class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-6 rounded-full transition">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
