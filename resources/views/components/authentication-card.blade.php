<div class="min-h-screen py-20" style="background-image: linear-gradient(115deg, #0b3968, #0b3a6852)">
    <div class="flex flex-col lg:flex-row w-10/12 lg:w-8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
        <!-- Imagen de fondo sin difuminación -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-12 bg-no-repeat bg-cover bg-center"
             style="background-image: url('{{ asset('images/registro.jpg') }}'); opacity: 0.85;">
            <h1 class="text-white text-3xl mb-3 drop-shadow-md">Bienvenido</h1>
            <div>
                <p class="text-white drop-shadow-md">Encuentra tu próximo desafío profesional. Conecta con miles de ofertas de empleo en tu área y descubre nuevas oportunidades. Filtra por industria, ubicación y tipo de contrato. ¡Tu futuro laboral te espera!</p>
            </div>
        </div>

        <!-- Contenido de la derecha -->
        <div class="w-full lg:w-1/2 py-16 px-12">
            <div class="flex flex-col lg:flex-row w-full lg:w-1/2 bg-white rounded-xl mx-auto shadow-lg">
                {{ $logo }}
            </div>

    {{ $slot }}
        </div>
    </div>
</div>
