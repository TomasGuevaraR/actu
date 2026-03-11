{{-- resources/views/auth/forgot-password.blade.php --}}

<x-guest-layout>

    <div class="w-full min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white shadow-xl rounded-xl border border-gray-200 p-8">

            {{-- Título --}}
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-[#0166b3]">
                    🔐 Recuperación de Contraseña
                </h2>
                <p class="text-sm text-gray-500 mt-2">
                    Sistema ACTU
                </p>
            </div>

            {{-- Contenido --}}
            <div class="text-sm text-gray-700 space-y-4">

                <p class="font-medium">
                    ¿Olvidaste tu contraseña?
                </p>

                <p>
                    Para restablecer el acceso al sistema,
                    comunícate directamente con el
                    <strong class="text-[#0166b3]">Administrador del Sistema (Pastor)</strong>,
                    quien podrá asignarte una nueva contraseña temporal.
                </p>

                <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-lg text-sm">
                    ⚠️ Una vez recibas la nueva contraseña:
                    <br><br>
                    Ingresa al sistema y dirígete a:
                    <br>
                    <strong>Mi Perfil → Cambiar Contraseña</strong>
                    <br><br>
                    para actualizarla por una contraseña personal y segura.
                </div>

            </div>

            {{-- Botón --}}
            <div class="mt-8">
                <a href="{{ route('login') }}"
                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-semibold rounded-lg shadow hover:bg-[#014c86] transition">
                    ← Volver al Inicio de Sesión
                </a>
            </div>

        </div>

    </div>

</x-guest-layout>