<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="relative min-h-screen w-full flex flex-col items-center justify-center">
        <div class="relative w-full">
            @if (auth()->check() && !auth()->user()->hasVerifiedEmail())
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-2 text-sm" role="alert">
                    <p>Tu dirección de correo electrónico no está verificada y no podrás acceder a todas las funcionalidades de la plataforma. Por favor, verifica tu dirección de correo electrónico desde el panel.</p>
                </div>
            @endif

            <x-home.header />

            <main class="my-2">
                {{ $slot }}
            </main>

            <x-home.footer />

        </div>
    </div>
</body>

</html>
