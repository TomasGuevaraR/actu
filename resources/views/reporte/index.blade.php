@extends('layouts.app')

@section('content')
@php
    $rolUsuario = Auth::user()->rol ?? '';
@endphp

@if ($rolUsuario !== 'secretario')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6 text-center">Reportes Generales</h1>
    {{-- Botón Volver alineado a la izquierda --}}
    <div class="flex justify-start mb-4">
        <a href="{{ route('dashboard') }}" 
            class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>

    {{-- Filtro por Año --}}
    <form method="GET" action="{{ route('reporte.index') }}" class="mb-8 flex justify-center items-center gap-4">
        <label for="anio" class="text-gray-700">Selecciona el año:</label>
        <select name="anio" id="anio" class="border border-gray-300 rounded px-7 py-2 text-sm">
            @foreach ($aniosDisponibles as $opcion)
                <option value="{{ $opcion }}" {{ $opcion == $anioSeleccionado ? 'selected' : '' }}>
                    {{ $opcion }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-800">
            Filtrar
        </button>
    </form>

    {{-- Contenedor de Gráficos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Gráfico 1: Ingresos vs Egresos Mensuales --}}
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-blue-700 mb-2">Ingresos vs Egresos ({{ $anioSeleccionado }})</h2>
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="graficoIE"></canvas>
            </div>
            @if(array_sum($ingresosMensuales) == 0 && array_sum($egresosMensuales) == 0)
                <p class="text-gray-500 text-center mt-4">No hay datos disponibles para este período</p>
            @endif
        </div>

        {{-- Gráfico 2: Estados de Miembros --}}
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold text-blue-700 mb-2">Estados de Miembros</h2>
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="graficoEstadosMiembros"></canvas>
            </div>
            @if(empty($estadosMiembros))
                <p class="text-gray-500 text-center mt-4">No hay datos de miembros disponibles</p>
            @endif
        </div>

        {{-- Botón para ir al reporte de Diezmo --}}
        <div class="bg-white p-4 rounded shadow flex flex-col items-center justify-center">
            <h2 class="text-xl font-semibold text-blue-700 mb-4">Diezmo</h2>
            <p class="text-gray-600 mb-4">Ver reporte de diezmos por persona.</p>
            <a href="{{ route('reporte.diezmo') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-800">
                Ver Reporte de Diezmo
            </a>
        </div>
    </div>
</div>
@else
<div class="container mx-auto px-4 py-6 text-center">
    <h1 class="text-2xl font-bold text-red-600">Acceso denegado</h1>
    <p class="text-gray-700 mt-2">No tienes permisos para acceder a esta sección.</p>
    <a href="{{ route('dashboard') }}" 
       class="inline-flex items-center mt-4 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-800 transition">
        <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
    </a>
</div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Gráfico de Ingresos vs Egresos
        const ctxIE = document.getElementById('graficoIE');
        const ingresos = {!! json_encode($ingresosMensuales) !!};
        const egresos = {!! json_encode($egresosMensuales) !!};
        const meses = {!! json_encode($meses) !!};

        const mesesConDatos = [];
        const ingresosFiltrados = [];
        const egresosFiltrados = [];

        meses.forEach((mes, index) => {
            if (ingresos[index] > 0 || egresos[index] > 0) {
                mesesConDatos.push(mes);
                ingresosFiltrados.push(ingresos[index]);
                egresosFiltrados.push(egresos[index]);
            }
        });

        if (ctxIE && (ingresosFiltrados.length > 0 || egresosFiltrados.length > 0)) {
            new Chart(ctxIE, {
                type: 'bar',
                data: {
                    labels: mesesConDatos,
                    datasets: [
                        {
                            label: 'Ingresos',
                            data: ingresosFiltrados,
                            backgroundColor: 'rgba(59, 130, 246, 0.7)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Egresos',
                            data: egresosFiltrados,
                            backgroundColor: 'rgba(239, 68, 68, 0.7)',
                            borderColor: 'rgba(239, 68, 68, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString('es-CO');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 20
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: $${context.raw.toLocaleString('es-CO')}`;
                                }
                            }
                        }
                    }
                }
            });
        }

        // 2. Gráfico Estados de Miembros
        const ctxEstados = document.getElementById('graficoEstadosMiembros');
        const estadosData = {!! json_encode($estadosMiembros) !!};

        if (ctxEstados && Object.keys(estadosData).length > 0) {
            const estadoColores = {
                'activo': '#4CAF50',
                'inactivo': '#F44336',
                'con excusa': '#FFC107',
                'borrado': '#607D8B',
                'ausente': '#FF9800',
                'fallecido': '#9C27B0',
                'trasladado': '#2196F3',
                'no bautizado': '#00BCD4'
            };

            const labels = Object.keys(estadosData).map(estado => 
                estado.charAt(0).toUpperCase() + estado.slice(1)
            );

            const data = Object.values(estadosData);
            const backgroundColors = Object.keys(estadosData).map(estado => 
                estadoColores[estado.toLowerCase()] || '#607D8B'
            );

            new Chart(ctxEstados, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 12,
                                padding: 20,
                                font: {
                                    size: 10
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const value = context.raw;
                                    const percentage = Math.round((value / total) * 100);
                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
