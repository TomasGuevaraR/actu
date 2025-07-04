<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ACTU')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Evitar caché -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0, private">

    <script>
        function toggleMenu() {
            const aside = document.getElementById('sidebar');
            aside.classList.toggle('w-[20%]');
            aside.classList.toggle('w-16');

            const elements = aside.querySelectorAll('.menu-label, .user-info, .copyright');
            elements.forEach(el => el.classList.toggle('hidden'));

            const icon = document.getElementById('toggle-icon');
            icon.classList.toggle('fa-angle-double-left');
            icon.classList.toggle('fa-angle-double-right');
        }
    </script>
</head>

<body class="@yield('body-class') bg-gray-100 flex min-h-screen">

    <!-- Menú lateral (20%) -->
    <aside id="sidebar" class="fixed top-0 left-0 h-full transition-all duration-300 w-[20%] bg-[#0166b3] text-white flex flex-col items-center py-4 z-50">
        <div class="flex flex-col items-center mb-4">
            <img src="https://img.icons8.com/color/80/user-male-circle--v1.png" alt="Usuario" class="w-16 h-16 rounded-full shadow-lg">
            <p class="mt-2 text-sm font-semibold user-info">{{ Auth::user()->nombre ?? 'Invitado' }}</p>
            <p class="text-xs text-blue-200 user-info">{{ Auth::user()->rol ?? 'Sin rol' }}</p>

        </div>

        <div class="absolute top-1/2 left-full transform -translate-y-1/2 -translate-x-1/2">
            <button onclick="toggleMenu()" class="text-white text-2xl hover:text-gray-300 transition">
                <i id="toggle-icon" class="fas fa-angle-double-left"></i>
            </button>
        </div>

        <!-- Menú navegación -->
        <nav class="flex flex-col items-start justify-start flex-grow space-y-2.7 mt-4 w-full px-4">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-home text-yellow-400"></i>
                <span class="menu-label">Inicio</span>
            </a>
            <a href="{{ route('libro-contable.index') }}" class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-book-open text-green-400"></i>
                <span class="menu-label">Libro Contable</span>
            </a>
            <a href="{{ route('presupuestos.index') }}" class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-coins text-yellow-300"></i>
                <span class="menu-label">Presupuestos</span>
            </a>
            <a href="{{ route('miembros.index') }}" class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-users text-purple-400"></i>
                <span class="menu-label">Miembros</span>
            </a>
            <a href="{{ route('usuarios.index') }}" class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-user-gear text-pink-400"></i>
                <span class="menu-label">Usuarios</span>
            </a>
            <a href="{{ route('reporte.index') }}" class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-chart-bar text-cyan-400"></i>
                <span class="menu-label">Reportes</span>
            </a>
            <a href="{{ route('mi-perfil.index') }}" class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-user-circle text-blue-300"></i>
                <span class="menu-label">Mi Perfil</span>
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="w-full px-4 mt-4">
            @csrf
            <button type="submit" class="flex items-center space-x-2 w-full px-2 py-2 rounded bg-red-500 hover:bg-red-600 text-white transition">
                <i class="fas fa-sign-out-alt"></i>
                <span class="menu-label">Cerrar sesión</span>
            </button>
        </form>

        <div class="text-center text-xs text-blue-100 px-2 mt-8 mb-2 copyright">
            &copy; 2025 Sistema ACTU. Todos los derechos reservados.
        </div>
    </aside>

    <!-- Contenido principal (80%) -->
    <main id="main-content" class="flex-1 ml-[20%]">
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
</html>
