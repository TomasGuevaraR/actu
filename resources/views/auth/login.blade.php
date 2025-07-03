{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestión de Iglesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Asegúrate de usar Vite si lo usas --}}
</head>
<body class="m-0 p-0 bg-white">
    <div class="flex w-full h-screen">

        {{-- Sección izquierda: 40% --}}
        <div class="w-2/5 bg-[#0166b3] flex flex-col items-center justify-center text-white p-10">
            <h1 class="text-4xl font-bold mb-8 text-center leading-tight">
                Sistema de Administración Contable de Iglesia Templo Unido.
            </h1>
            <img src="{{ asset('images/logo iglesia.png') }}" alt="Logo Iglesia" class="w-48 h-auto">
        </div>

        {{-- Sección derecha: 60% --}}
        <div class="w-3/5 bg-white flex items-center justify-center p-10">
            <div class="w-full max-w-md">

                {{-- Estado de sesión --}}
                @if (session('status'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Correo electrónico --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input id="email" name="email" type="email" required autofocus
                            value="{{ old('email') }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0166b3] focus:border-[#0166b3]">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0166b3] focus:border-[#0166b3]">
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Recuérdame --}}
                    <div class="block mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-[#0166b3] shadow-sm focus:ring-[#0166b3]">
                            <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
                        </label>
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif

                        <button type="submit"
                            class="ml-3 bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded">
                            Iniciar sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
</html>
