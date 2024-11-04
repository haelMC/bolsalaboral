<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap (si es necesario, pero puede causar conflicto con Tailwind) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vite (Tailwind CSS & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AlpineJS (para manejar x-data, x-show, etc.) -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100" x-data="{ mobileSidebarOpen: false, desktopSidebarOpen: true, userDropdownOpen: false }">
    <!-- Banner -->
    <x-banner />

    <!-- Navegación principal -->
    @livewire('navigation-menu')

    <!-- Sidebar y Contenido principal -->
    <div class="flex">
        <!-- Sidebar -->
        <x-sliderbar.container />

        <!-- Contenido principal -->
        <main id="page-content" class="w-full px-4 sm:px-6 lg:px-8 pt-16">
            {{ $slot }}
        </main>
    </div>

    <!-- Livewire Modals -->
    @stack('modals')

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Scripts adicionales -->
    <script type="text/javascript">
        Livewire.on('alert', function(message) {
            Swal.fire(
                'Mensaje del sistema',
                message,
                'success'
            )
        });
    </script>
    @stack('js')
</body>
</html>
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Esto es una prueba de Alpine.js</div>
</div>
