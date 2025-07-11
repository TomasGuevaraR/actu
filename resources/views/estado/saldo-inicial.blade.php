{{-- resources/views/estado/saldo-inicial.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md border border-gray-200">
    <h2 class="text-2xl font-bold text-[#0166b3] mb-6 text-center">💼 Ingresar Saldo Inicial del Año</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4 border border-red-300">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estado.saldo-inicial.guardar') }}" method="POST" id="form-saldo">
        @csrf

        <div class="mb-5">
            <label for="anio" class="block text-sm font-semibold text-gray-700 mb-1">📅 Año *</label>
            <input type="number" name="anio" id="anio" value="{{ old('anio', now()->year) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0166b3] transition">
        </div>

        <div class="mb-6">
            <label for="saldo_inicial" class="block text-sm font-semibold text-gray-700 mb-1">💰 Saldo Inicial *</label>
            <input type="number" step="0.01" name="saldo_inicial" id="saldo_inicial" value="{{ old('saldo_inicial') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0166b3] transition">
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-5 rounded-full transition">
                <i class="bi bi-save"></i> Guardar
            </button>

            <a href="{{ route('estado.index') }}"
               class="text-[#0166b3] hover:underline font-medium">
               <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>

{{-- Opcional: SweetAlert2 para confirmar envío --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const form = document.getElementById('form-saldo');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Confirmar?',
            text: "¿Deseas guardar el saldo inicial?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0166b3',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
