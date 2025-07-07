@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4 px-4 pt-4">
    <!-- Título a la izquierda -->
    <h1 class="text-2xl font-bold text-[#0166b3]">
        <i class="bi bi-journal-text me-2"></i> Libro Contable
    </h1>

    <!-- Botones a la derecha -->
    <div class="flex flex-col md:flex-row md:items-center gap-4 w-full md:w-auto">
        <a href="{{ route('ingresos.create') }}"
            class="bg-[#0d6efd] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded-full transition duration-300 shadow-md">
            ➕ Ingreso
        </a>

        <a href="{{ route('egresos.create') }}"
            class="bg-[#dc3545] hover:bg-[#a71d2a] text-white font-bold py-2 px-4 rounded-full transition duration-300 shadow-md">
            ➖ Egreso
        </a>

        <a href="{{ route('diezmos.index') }}"
            class="bg-[#198754] hover:bg-[#146c43] text-white font-bold py-2 px-4 rounded-full transition duration-300 shadow-md">
            💰 Diezmo y Ofrenda
        </a>
    </div>
</div>

</div>


        <!-- Tabla -->
        <div class="card-body px-4 py-4">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded shadow-sm">
                    <thead class="bg-[#0166b3] text-white text-sm">
                        <tr>
                            <th class="py-2 px-4 border">Fecha</th>
                            <th class="py-2 px-4 border">Detalle</th>
                            <th class="py-2 px-4 border">Concepto</th>
                            <th class="py-2 px-4 border">Valor</th>
                            <th class="py-2 px-4 border">Entrada</th>
                            <th class="py-2 px-4 border">Salida</th>
                            <th class="py-2 px-4 border">Saldo</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @forelse ($movimientos as $mov)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border">{{ $mov->fecha }}</td>
                                <td class="py-2 px-4 border">{{ $mov->detalle }}</td>
                                <td class="py-2 px-4 border">{{ $mov->concepto }}</td>
                                <td class="py-2 px-4 border">{{ number_format($mov->valor, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border text-green-600 fw-semibold">
                                    {{ $mov->tipo === 'ingreso' ? number_format($mov->valor, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-2 px-4 border text-red-600 fw-semibold">
                                    {{ $mov->tipo === 'egreso' ? number_format($mov->valor, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-2 px-4 border fw-semibold">
                                    {{ number_format($mov->saldo, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">No hay movimientos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
