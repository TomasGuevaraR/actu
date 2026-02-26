@php
    use Carbon\Carbon;
    use App\Models\LibroContable;

    $libroActivo = $libroActivo ?? LibroContable::where('estado', 'activo')->first();
    $fechaMin = $fechaMax = $fechaDefault = date('Y-m-d');

    if ($libroActivo) {
        $fechaInicio = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->startOfMonth();
        $fechaFin = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->endOfMonth();

        $fechaMin = $fechaInicio->format('Y-m-d');
        $fechaMax = $fechaFin->format('Y-m-d');

        $hoy = Carbon::today();
        if ($hoy->lt($fechaInicio)) {
            $fechaDefault = $fechaMin;
        } elseif ($hoy->gt($fechaFin)) {
            $fechaDefault = $fechaMax;
        } else {
            $fechaDefault = $hoy->format('Y-m-d');
        }
    }
@endphp

@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Botón Volver -->
        <div class="mb-4 ml-[1cm]">
            <a href="{{ route('libro.index') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full transition">
                ← Volver al Libro Contable
            </a>
        </div>

        <!-- Formulario -->
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-[#0166b3] mb-6 text-center">Registrar Ingreso</h2>

            {{-- Mostrar errores --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formIngreso" action="{{ route('ingresos.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Fecha -->
                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del Ingreso</label>
                        <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $fechaDefault) }}"
                            min="{{ $fechaMin }}" max="{{ $fechaMax }}"
                            class="form-control @error('fecha') border-red-500 @enderror" required>
                        @error('fecha')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Consecutivo (opcional) -->
                    <div>
                        <label for="consecutivo" class="block text-sm font-medium text-gray-700">Consecutivo
                            (opcional)</label>
                        <input type="text" name="consecutivo" id="consecutivo" value="{{ old('consecutivo') }}"
                            class="form-control @error('consecutivo') border-red-500 @enderror" placeholder="Ej: ING-0001">
                        @error('consecutivo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Recibido de -->
                    <div>
                        <label for="detalle" class="block text-sm font-medium text-gray-700">Recibido de...</label>
                        <input type="text" name="detalle" id="detalle" value="{{ old('detalle') }}"
                            class="form-control @error('detalle') border-red-500 @enderror"
                            placeholder="Ej: Donación, venta, etc." required>
                        @error('detalle')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Concepto -->
                    <div>
                        <label for="concepto" class="block text-sm font-medium text-gray-700">Concepto</label>
                        <input type="text" name="concepto" id="concepto" value="{{ old('concepto') }}"
                            class="form-control @error('concepto') border-red-500 @enderror"
                            placeholder="Ej: Ingreso general, evento especial" required>
                        @error('concepto')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Valor -->
                    <div>
                        <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                        <input type="number" name="valor" id="valor" value="{{ old('valor') }}"
                            class="form-control @error('valor') border-red-500 @enderror" placeholder="Ej: 50000" required
                            min="0">
                        @error('valor')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="tipo" value="ingreso">

                <!-- Botón Guardar -->
                <div class="text-center mt-8">
                    <button type="button" onclick="abrirModal()"
                        class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-6 rounded-full transition">
                        Guardar Ingreso
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalIngreso" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center">
            <h3 class="text-lg font-semibold mb-4 text-[#0166b3]">¿Deseas guardar este ingreso?</h3>
            <div class="flex justify-center gap-4">
                <button onclick="cerrarModal()"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">Cancelar</button>
                <button onclick="document.getElementById('formIngreso').submit()"
                    class="px-4 py-2 bg-[#0166b3] hover:bg-[#014a82] text-white rounded">
                    Sí, Guardar
                </button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        function abrirModal() {
            document.getElementById('modalIngreso').classList.remove('hidden');
            document.getElementById('modalIngreso').classList.add('flex');
        }
        function cerrarModal() {
            document.getElementById('modalIngreso').classList.add('hidden');
            document.getElementById('modalIngreso').classList.remove('flex');
        }
    </script>
@endsection