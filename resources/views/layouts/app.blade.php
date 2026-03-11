<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ACTU')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//unpkg.com/alpinejs" defer></script>


    <!-- Evitar caché -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0, private">

    <script>
        function toggleMenu() {
            const aside = document.getElementById('sidebar');
            const main = document.getElementById('main-content');

            const isExpanded = aside.classList.contains('w-[20%]');

            if (isExpanded) {
                // Contraer menú
                aside.classList.remove('w-[20%]');
                aside.classList.add('w-16');

                main.classList.remove('ml-[20%]');
                main.classList.add('ml-16');
            } else {
                // Expandir menú
                aside.classList.remove('w-16');
                aside.classList.add('w-[20%]');

                main.classList.remove('ml-16');
                main.classList.add('ml-[20%]');
            }

            // Ocultar labels
            const elements = aside.querySelectorAll('.menu-label, .user-info, .copyright');
            elements.forEach(el => el.classList.toggle('hidden'));

            // Cambiar icono
            const icon = document.getElementById('toggle-icon');
            icon.classList.toggle('fa-angle-double-left');
            icon.classList.toggle('fa-angle-double-right');
        }
    </script>
</head>



<body class="@yield('body-class') bg-gray-100 flex min-h-screen">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')

    <!-- Menú lateral (20%) -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-full transition-all duration-300 w-[20%] bg-[#0166b3] text-white flex flex-col items-center py-4 z-50">
        <div class="flex flex-col items-center mb-4">
            <i class="fas fa-user-circle text-white text-6xl shadow-lg"></i>

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
            <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-home text-yellow-400"></i>
                <span class="menu-label">Inicio</span>
            </a>
            <a href="{{ route('libro.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-book-open text-green-400"></i>
                <span class="menu-label">Libro Contable</span>
            </a>
            <a href="{{ route('presupuestos.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-coins text-yellow-300"></i>
                <span class="menu-label">Presupuestos</span>
            </a>
            <a href="{{ route('estado.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-file-invoice  text-pink-200 text-[#0166b3]"></i>
                <span class="menu-label ">Estado Financiero</span>
            </a>

            <a href="{{ route('miembros.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-users text-purple-400"></i>
                <span class="menu-label">Miembros</span>
            </a>

            <a href="{{ route('diezmo.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-hand-holding-heart text-green-500"></i>
                <span class="menu-label">Diezmos/Ofrendas</span>
            </a>


            <a href="{{ route('usuarios.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-user-gear text-pink-400"></i>
                <span class="menu-label">Usuarios</span>
            </a>
            <a href="{{ route('reporte.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-chart-bar text-cyan-400"></i>
                <span class="menu-label">Reportes</span>
            </a>
            <a href="{{ route('mi-perfil.index') }}"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded hover:bg-white hover:text-[#0166b3] transition">
                <i class="fas fa-user-circle text-blue-300"></i>
                <span class="menu-label">Mi Perfil</span>
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="w-full px-4 mt-4">
            @csrf
            <button type="submit"
                class="flex items-center space-x-2 w-full px-2 py-2 rounded bg-red-500 hover:bg-red-600 text-white transition">
                <i class="fas fa-sign-out-alt"></i>
                <span class="menu-label">Cerrar sesión</span>
            </button>
        </form>

        <div class="text-center text-xs text-blue-100 px-2 mt-8 mb-2 copyright">
            <a href="{{ route('acerca') }}" target="_blank" class="hover:underline">
                &copy; {{ date('Y') }} Sistema ACTU. Todos los derechos reservados.
            </a>
        </div>
    </aside>

    <!-- Contenido principal (80%) -->
    <main id="main-content" class="flex-1 ml-[20%] transition-all duration-300">
        @yield('content')
    </main>


    <!-- Scripts -->
    <script>
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>


    <script>
        let sessionCheckInterval = 300000; // 5 minutos
        let warningTime = 600000; // 10 minutos

        // Mantener sesión activa
        setInterval(function () {
            fetch('/keep-session-alive')
                .catch(() => console.log("No se pudo mantener la sesión"));
        }, sessionCheckInterval);


        // Mostrar advertencia si el usuario lleva mucho tiempo
        let warningTimer = setTimeout(function () {
            alert("⚠️ Tu sesión está a punto de expirar.\n\nGuarda la información para evitar perder los datos.");
        }, warningTime);


        // Reiniciar contador si el usuario interactúa
        function resetSessionTimer() {
            clearTimeout(warningTimer);
            warningTimer = setTimeout(function () {
                alert("⚠️ Tu sesión está a punto de expirar.\n\nGuarda la información para evitar perder los datos.");
            }, warningTime);
        }

        // Detectar actividad del usuario
        document.addEventListener("click", resetSessionTimer);
        document.addEventListener("keypress", resetSessionTimer);
        document.addEventListener("mousemove", resetSessionTimer);
    </script>
</body>

</html>