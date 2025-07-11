<!-- Contenido principal -->
        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        function verificarAutenticacion() {
            fetch('/check-auth-status', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (!data.authenticated) {
                    window.location.href = '/login';
                }
            })
            .catch(error => console.error('Error verificando autenticación:', error));
        }

        if (document.body.classList.contains('authenticated-page')) {
            setInterval(verificarAutenticacion, 60000);
        }
    </script>
</body>
</html>  <!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen bg-gray-50 items-center w-full max-w-7xl mx-auto px-4 py-4"> <!-- Contenedor más ancho y centrado -->
    <!-- Encabezado -->
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo-actu.png') }}" alt="Logo ACTU" class="mx-auto" style="width: 140px; height: 120px; margin-top: 0;">
        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mt-2">
            Sistema de Administración Contable de la Iglesia Templo Unido
        </h1>
    </div>

    <!-- Módulos -->
    
    @php
        $modulosPrimeraFila = [
            ['titulo' => 'Libro Contable', 'icono' => 'fa-book', 'color' => 'text-green-600', 'ruta' => route('libro.index')],
            ['titulo' => 'Presupuestos', 'icono' => 'fa-coins', 'color' => 'text-yellow-500', 'ruta' => route('presupuestos.index')],
            ['titulo' => 'Estado Financiero', 'icono' => 'fa-file-invoice-dollar', 'color' => 'text-cyan-600', 'ruta' => route('estado.index')],
            ['titulo' => 'Miembros', 'icono' => 'fa-users', 'color' => 'text-blue-500', 'ruta' => route('miembros.index')],
        ];

        $modulosSegundaFila = [
            ['titulo' => 'Usuarios', 'icono' => 'fa-user-shield', 'color' => 'text-indigo-600', 'ruta' => route('usuarios.index')],
            ['titulo' => 'Reportes', 'icono' => 'fa-chart-bar', 'color' => 'text-purple-600', 'ruta' => route('reporte.index')],
            ['titulo' => 'Mi Usuario', 'icono' => 'fa-user', 'color' => 'text-pink-500', 'ruta' => route('mi-perfil.index')],
        ];
    @endphp

    <!-- Primera fila (4 módulos) -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6 w-full justify-center mb-6">
        @foreach ($modulosPrimeraFila as $modulo)
            <a href="{{ $modulo['ruta'] }}" class="bg-white shadow-md rounded-xl p-4 h-40 flex flex-col justify-center items-center text-center transform transition hover:scale-105 hover:shadow-lg">
                <div class="text-3xl mb-2">
                    <i class="fas {{ $modulo['icono'] }} {{ $modulo['color'] }}"></i>
                </div>
                <h2 class="text-sm font-semibold text-gray-700">{{ $modulo['titulo'] }}</h2>
            </a>
        @endforeach
    </div>

<!-- Segunda fila (3 módulos más angostos y centrados) -->
<div class="flex justify-center gap-6">
    @foreach ($modulosSegundaFila as $modulo)
        <a href="{{ $modulo['ruta'] }}"
            class="bg-white shadow-md rounded-xl p-4 h-40 w-[290px] flex flex-col justify-center items-center text-center transform transition hover:scale-105 hover:shadow-lg">
            <div class="text-3xl mb-2">
                <i class="fas {{ $modulo['icono'] }} {{ $modulo['color'] }}"></i>
            </div>
            <h2 class="text-sm font-semibold text-gray-700">{{ $modulo['titulo'] }}</h2>
        </a>
    @endforeach
</div>
</div>
@endsection

