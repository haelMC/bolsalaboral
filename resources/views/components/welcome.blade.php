<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<div class="swiper-container">
    <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide">
            <div class="relative bg-cover bg-center h-96" style="background-image: url('{{ asset('images/banner_image.jpg') }}');">
                <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
                <div class="relative z-10 flex items-center justify-center h-full">
                    <div class="text-center text-white">
                        <h1 class="text-4xl font-bold">Conectamos a Estudiantes y Egresados con Oportunidades Laborales De las mejores empresas</h1>
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
                        <h1 class="text-4xl font-bold">Otra oportunidad laboral</h1>
                        <p class="mt-4 text-lg">¡Descubre más!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Puedes agregar más slides -->
    </div>

    <!-- Controles de navegación -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Indicadores de paginación -->
    <div class="swiper-pagination"></div>
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Inicialización de Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.swiper-container', {
            loop: false,  // Desactiva temporalmente el bucle
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 7000,  // Aumenta el tiempo entre diapositivas
                disableOnInteraction: true,  // Pausar el autoplay cuando el usuario interactúe
            },
        });
    });
</script>

<!-- Botón de "Explorar Ofertas de Trabajo" -->
<div class="mt-8 flex justify-center">
    <a href="{{ route('joboffers') }}" class="bg-indigo-600 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-indigo-700 transition duration-300 transform hover:scale-105">
        Explorar Ofertas de Trabajo
    </a>
</div>
<!-- Sección de Instituciones Aliadas -->
<div class="mt-16 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Instituciones Aliadas</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Institución 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('images/upeu.jpg') }}" alt="Encargado de DTI" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800">UPeU</h3>
                <p class="mt-2 text-gray-600">Ser referente en el mundo por el modelamiento de profesionales íntegros, misioneros e innovadores con un estilo de vida saludable</p>
                <div class="mt-4">
                    <span class="text-2xl font-bold text-indigo-600">1000 Egresado</span>
                    <span class="text-gray-500">/año</span>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold">Ver detalles</a>
                </div>
            </div>
        </div>

        <!-- Institución 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('images/UNAJ.png') }}" alt="Encargado de DTI" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800">UNAJ</h3>
                <p class="mt-2 text-gray-600">La UNAJ es una institución universitaria moderna que forma profesionales competitivos con conocimiento científico y valores socioculturales, donde se desarrolla la investigación científica y se promueve la innovación tecnológica, relacionándose con la comunidad con responsabilidad social buscando su desarrollo y solución a sus problemas.</p>
                <div class="mt-4">
                    <span class="text-2xl font-bold text-indigo-600">500 Egresados</span>
                    <span class="text-gray-500">/año</span>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold">Ver detalles</a>
                </div>
            </div>
        </div>

        <!-- Institución 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('images/upeu.jpg') }}" alt="Encargado de DTI" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800">UPeU</h3>
                <p class="mt-2 text-gray-600">Ser referente en el mundo por el modelamiento de profesionales íntegros, misioneros e innovadores con un estilo de vida saludable</p>
                <div class="mt-4">
                    <span class="text-2xl font-bold text-indigo-600">1000 Egresado</span>
                    <span class="text-gray-500">/año</span>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold">Ver detalles</a>
                </div>
            </div>
        </div>

        <!-- Institución 4 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('images/UNAJ.png') }}" alt="Encargado de DTI" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800">UNAJ</h3>
                <p class="mt-2 text-gray-600">La UNAJ es una institución universitaria moderna que forma profesionales competitivos con conocimiento científico y valores socioculturales, donde se desarrolla la investigación científica y se promueve la innovación tecnológica, relacionándose con la comunidad con responsabilidad social buscando su desarrollo y solución a sus problemas.</p>
                <div class="mt-4">
                    <span class="text-2xl font-bold text-indigo-600">500 Egresados</span>
                    <span class="text-gray-500">/año</span>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold">Ver detalles</a>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Tarjeta de ofertas laborales -->
