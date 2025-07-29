@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
        <h2 class="text-3xl font-bold text-[#0166b3]">📊 Módulo de Reportes</h2>

        <form action="{{ route('reportes.store') }}" method="POST" class="flex flex-col md:flex-row gap-3">
            @csrf
            <input type="text" name="titulo" placeholder="Título" required class="p-2 border rounded w-full md:w-48">
            <input type="text" name="autor" placeholder="Autor" required class="p-2 border rounded w-full md:w-32">
            <input type="date" name="fecha" required class="p-2 border rounded w-full md:w-36">
            <input type="text" name="descripcion" placeholder="Descripción" class="p-2 border rounded w-full md:w-64">
            <button type="submit" class="bg-[#0166b3] text-white px-4 py-2 rounded hover:bg-[#014a82]">Crear</button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Autor</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $reporte->titulo }}</td>
                        <td class="px-4 py-2">{{ $reporte->autor }}</td>
                        <td class="px-4 py-2">{{ $reporte->fecha }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este reporte?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($reportes->isEmpty())
                    <tr><td colspan="5" class="px-4 py-2 text-center text-gray-500">No hay reportes aún.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
