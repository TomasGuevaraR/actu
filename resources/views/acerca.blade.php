@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-12 p-8 bg-white shadow-lg rounded-lg">

        <h1 class="text-3xl font-bold text-center mb-6">
            Sistema ACTU
        </h1>

        <p class="text-lg text-gray-700 mb-4">
            <strong>ACTU</strong> (Sistema de Administración Contable de la Iglesia Templo Unido)
            es una plataforma desarrollada para optimizar los procesos contables y administrativos
            de la Iglesia Templo Unido.
        </p>

        <p class="text-gray-700 mb-4">
            El sistema permite llevar un control organizado de ingresos, egresos y reportes financieros,
            garantizando transparencia, eficiencia y una mejor gestión de los recursos de la iglesia.
        </p>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-3">Información del Desarrollador</h2>

        <div class="text-gray-700 space-y-2">
            <p><strong>Nombre:</strong> Tomas Guevara R.</p>
            <p><strong>Teléfono:</strong> 321 872 1623</p>
            <p><strong>Correo:</strong>
                <a href="mailto:tomasguevara2024@gmail.com" class="text-blue-600 hover:underline">
                    tomasguevara2024@gmail.com
                </a>
            </p>
            <p>
                <strong>Portafolio:</strong>
                <a href="https://tomasguevarar.github.io/tomasguevara/" target="_blank"
                    class="text-blue-600 hover:underline">
                    Ver sitio web
                </a>
            </p>
            <p>
                <strong>GitHub:</strong>
                <a href="https://github.com/TomasGuevaraR" target="_blank" class="text-blue-600 hover:underline">
                    github.com/TomasGuevaraR
                </a>
            </p>
        </div>

        <hr class="my-6">

        <p class="text-center text-sm text-gray-500">
            © {{ date('Y') }} Sistema ACTU. Todos los derechos reservados a la Iglesia Templo Unido.
        </p>

    </div>
@endsection