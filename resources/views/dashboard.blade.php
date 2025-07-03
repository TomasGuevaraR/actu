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
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 w-full">
        @php
            $modulos = [
                ['titulo' => 'Libro Contable', 'icono' => 'fa-book', 'color' => 'text-green-600', 'ruta' => route('libro-contable.index')],
                ['titulo' => 'Presupuesto', 'icono' => 'fa-coins', 'color' => 'text-yellow-500', 'ruta' => route('presupuesto.index')],
                ['titulo' => 'Miembros', 'icono' => 'fa-users', 'color' => 'text-blue-500', 'ruta' => route('miembros.index')],
                ['titulo' => 'Usuarios', 'icono' => 'fa-user-shield', 'color' => 'text-indigo-600', 'ruta' => route('usuarios.index')],
                ['titulo' => 'Reportes', 'icono' => 'fa-chart-bar', 'color' => 'text-purple-600', 'ruta' => route('reporte.index')],
                ['titulo' => 'Mi Usuario', 'icono' => 'fa-user', 'color' => 'text-pink-500', 'ruta' => route('mi-perfil.index')],
            ];
        @endphp

        @foreach ($modulos as $modulo)
            <a href="{{ $modulo['ruta'] }}" class="bg-white shadow-md rounded-xl p-4 w-49 h-44 flex flex-col justify-center items-center text-center transform transition hover:scale-105 hover:shadow-lg">
                <div class="text-4xl mb-4">
                    <i class="fas {{ $modulo['icono'] }} {{ $modulo['color'] }}"></i>
                </div>
                <h2 class="text-lg font-semibold text-gray-700">{{ $modulo['titulo'] }}</h2>
            </a>
        @endforeach
    </div>
</div>
@endsection

