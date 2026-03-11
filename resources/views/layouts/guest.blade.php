<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACTU - Sistema Contable</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">

    <div class="min-h-screen flex items-center justify-center bg-[#0166b3] px-4">

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>

    </div>

</body>

</html>