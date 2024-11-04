<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bolsa Laboral</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-700">
    <div class="min-h-screen flex flex-col justify-between">
        <!-- Navbar -->
        <nav class="bg-white shadow-lg py-4">
            <div class="container mx-auto px-6 md:px-12 flex items-center justify-between">
                <a href="#" class="text-xl font-bold text-gray-800">Bolsa Laboral</a>
                <div>
                    @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Ingrese</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900">Regístrate</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Swiper Slider para la imagen de fondo -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="relative bg-cover bg-center h-96" style="background-image: url('{{ asset('images/banner_image.jpg') }}');">
                        <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
                        <div class="relative z-10 flex items-center justify-center h-full">
                            <div class="text-center text-white">
                                <h1 class="text-4xl font-bold">Conectamos a Estudiantes y Egresados</h1>
                                <p class="mt-4 text-lg">Con las mejores oportunidades laborales</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="relative bg-cover bg-center h-96" style="background-image: url('{{ asset('images/banner_image2.avif') }}');">
                        <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
                        <div class="relative z-10 flex items-center justify-center h-full">
                            <div class="text-center text-white">
                                <h1 class="text-4xl font-bold">Descubre Nuevas Oportunidades</h1>
                                <p class="mt-4 text-lg">Únete a nuestro equipo de trabajo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agrega más slides si lo necesitas -->
            </div>

            <!-- Paginación y botones de navegación -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true, // Para que el slider sea infinito
            autoplay: {
                delay: 5000, // Tiempo entre los slides (5 segundos)
                disableOnInteraction: false, // Continúa el autoplay aunque se interactúe con el slider
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
        </script>

        <!-- Contenido Principal -->
        <div class="container mx-auto px-6 md:px-12 py-12">
            <!-- Introducción -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">Bienvenido a la Bolsa Laboral</h1>
                <p class="text-lg text-gray-600">Explora las mejores oportunidades laborales y encuentra el trabajo ideal para ti.</p>
            </div>



            <!-- Oportunidades Laborales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <!-- Oportunidad 1 -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <img src="{{ asset('images/encargado_dti.jpg') }}" alt="Encargado de DTI" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Encargado de DTI</h2>
                    <p class="text-gray-600">Gestiona proyectos de TI en una empresa líder del mercado.</p>
                    <div class="mt-4 text-gray-800">
                        <span class="text-xl font-bold">$2000.00</span> /mes
                    </div>
                    <a href="#" class="mt-6 inline-block text-indigo-500 hover:text-indigo-700">Ver detalles</a>
                </div>

                <!-- Oportunidad 2 -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <img src="{{ asset('images/ullstack_developer.jpg') }}" alt="Desarrollador Full Stack" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Desarrollador Full Stack</h2>
                    <p class="text-gray-600">Únete a un equipo dinámico y desarrolla soluciones web de alto impacto.</p>
                    <div class="mt-4 text-gray-800">
                        <span class="text-xl font-bold">$3500.00</span> /mes
                    </div>
                    <a href="#" class="mt-6 inline-block text-indigo-500 hover:text-indigo-700">Ver detalles</a>
                </div>

                <!-- Oportunidad 3 -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <img src="{{ asset('images/analista_datos.jpg') }}" alt="Analista de Datos" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Analista de Datos</h2>
                    <p class="text-gray-600">Analiza grandes volúmenes de datos y ayuda a mejorar la toma de decisiones.</p>
                    <div class="mt-4 text-gray-800">
                        <span class="text-xl font-bold">$2800.00</span> /mes
                    </div>
                    <a href="#" class="mt-6 inline-block text-indigo-500 hover:text-indigo-700">Ver detalles</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white shadow-lg py-6">
            <div class="container mx-auto px-6 md:px-12 text-center text-gray-600">
                <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
                <p>&copy; {{ date('Y') }} Bolsa Laboral. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>

</html>
