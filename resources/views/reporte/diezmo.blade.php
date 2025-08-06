@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-4 text-center text-[#0166b3]">Reporte de Diezmos</h2>

    <div class="flex justify-between items-center mt-4">
    

    <a href="{{ route('reporte.diezmos.excel', request()->all()) }}" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
        Exportar a Excel
    </a>
</div>


    <form method="GET" class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-2">
    <input type="text" name="nombre" value="{{ request('nombre') }}" placeholder="Nombre" class="border p-2 rounded-md">
    
    <input type="date" name="fecha" value="{{ request('fecha') }}" class="border p-2 rounded-md">

    <select name="mes" class="border p-2 rounded-md">
        <option value="">-- Mes --</option>
        @foreach(range(1,12) as $m)
            <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                {{ \Carbon\Carbon::create()->month($m)->locale('es')->monthName }}
            </option>
        @endforeach
    </select>

    <select name="anio" class="border p-2 rounded-md">
        <option value="">-- Año --</option>
        @for($y = now()->year; $y >= now()->year - 10; $y--)
            <option value="{{ $y }}" {{ request('anio') == $y ? 'selected' : '' }}>{{ $y }}</option>
        @endfor
    </select>

    <button type="submit" class="col-span-1 md:col-span-4 bg-[#0166b3] text-white py-2 rounded-md hover:bg-[#014a84] transition">Filtrar</button>
</form>


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
                        <td class="py-2 px-4">{{ date('d/m/Y', strtotime($item->fecha)) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 px-4 text-center text-gray-500">No hay registros de diezmos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
