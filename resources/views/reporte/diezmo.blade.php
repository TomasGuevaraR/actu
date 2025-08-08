@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- TÍTULO --}}
    <h2 class="text-3xl font-semibold text-center text-[#0166b3] mb-6">Reporte de Diezmos</h2>

{{-- BOTÓN VOLVER ATRÁS --}}
<div class="mb-4">
    <a href="{{ route('reporte.index') }}" class="inline-flex items-center text-sm text-blue-700 hover:text-blue-900 transition font-semibold">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
        </svg>
        Volver a Reportes
    </a>
</div>



    {{-- BOTÓN DE EXPORTACIÓN --}}
    <form action="{{ route('reporte.diezmos.excel') }}" method="GET" class="mb-4">
        <input type="hidden" name="nombre" value="{{ request('nombre') }}">
        <input type="hidden" name="fecha" value="{{ request('fecha') }}">
        <input type="hidden" name="mes" value="{{ request('mes') }}">
        <input type="hidden" name="anio" value="{{ request('anio') }}">

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Exportar CSV
        </button>
    </form>

    {{-- FORMULARIO DE FILTROS --}}
    <form method="GET" class="bg-white p-4 rounded-md shadow mb-6 grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" name="nombre" value="{{ request('nombre') }}" placeholder="Nombre"
                class="border p-2 w-full rounded-md shadow-sm focus:ring focus:ring-[#0166b3]/50">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
            <input type="date" name="fecha" value="{{ request('fecha') }}"
                class="border p-2 w-full rounded-md shadow-sm focus:ring focus:ring-[#0166b3]/50">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mes</label>
            <select name="mes" class="border p-2 w-full rounded-md shadow-sm focus:ring focus:ring-[#0166b3]/50">
                <option value="">-- Mes --</option>
                @foreach(range(1,12) as $m)
                    <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->locale('es')->monthName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
            <select name="anio" class="border p-2 w-full rounded-md shadow-sm focus:ring focus:ring-[#0166b3]/50">
                <option value="">-- Año --</option>
                @for($y = now()->year; $y >= now()->year - 10; $y--)
                    <option value="{{ $y }}" {{ request('anio') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit"
                class="bg-[#0166b3] text-white px-4 py-2 rounded-md hover:bg-[#014a84] transition w-full">
                Filtrar
            </button>
            <a href="{{ route('reporte.diezmo') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition w-full text-center">
                Limpiar
            </a>
        </div>
    </form>

    {{-- TABLA DE RESULTADOS --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm text-sm">
            <thead class="bg-[#0166b3] text-white">
                <tr>
                    <th class="py-2 px-4 text-left">Nombre</th>
                    <th class="py-2 px-4 text-left">Total Diezmo</th>
                    <th class="py-2 px-4 text-left">Fecha</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 divide-y divide-gray-200">
                @forelse($diezmos as $item)
                    <tr class="hover:bg-gray-100 transition-colors">
                        <td class="py-2 px-4">{{ $item->nombre }}</td>
                        <td class="py-2 px-4">${{ number_format($item->total, 0, ',', '.') }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 px-4 text-center text-gray-500">
                            No hay registros de diezmos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PIE DE RESULTADOS: TOTAL Y FECHA --}}
    <div class="mt-6 text-center">
        @if(isset($ultimaFecha))
            <p class="text-sm text-gray-600 mb-1">
                Mostrando registros del: <span class="font-semibold text-blue-600">
                    {{ \Carbon\Carbon::parse($ultimaFecha)->format('d/m/Y') }}
                </span>
            </p>
        @endif

        <p class="text-lg font-semibold">
            Total: <span class="text-green-600">
                ${{ isset($total) ? number_format($total, 0, ',', '.') : '0' }}
            </span>
        </p>
    </div>

</div>
@endsection
