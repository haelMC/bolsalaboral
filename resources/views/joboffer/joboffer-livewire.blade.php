<!-- Contenedor principal de la sección de ofertas de trabajo -->
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            <!-- Título destacado de la sección -->
            <h2 class="text-3xl font-extrabold text-center text-blue-800 mb-2">Descubre Oportunidades Laborales Únicas</h2>
            <p class="text-center text-gray-600 mb-6 text-lg">
                Encuentra la posición que has estado buscando. Revisa cada oferta para conocer los detalles y postúlate directamente. ¡Esta puede ser tu próxima gran oportunidad!
            </p>

            <!-- Grid de tarjetas de ofertas de trabajo -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                <!-- Itera sobre cada oferta de trabajo -->
                @foreach ($joboffers as $joboffer)
                    <a href="{{ route('joboffers.show', $joboffer->id) }}"
                        @if ($joboffer->isNewButton) wire:click.prevent="selectAndRedirect({{ $joboffer->id }})"
                        @endif class="flex flex-col relative shadow-2xl rounded-b-lg">

                        <!-- Imagen y detalles destacados de la oferta -->
                        <div class="bg-white overflow-hidden rounded-t-sm">

                            <div class="absolute top-4 left-4 bg-gray-800 bg-opacity-50 rounded-full">
                                <span class="text-white text-sm tracking-wider capitalize">{{ $joboffer->category->name }}</span>
                            </div>
                            <div class="absolute top-4 right-4 bg-gray-800 bg-opacity-50 rounded-full">
                                <span class="text-white text-sm tracking-wider">$ {{ $joboffer->salary }}</span>
                            </div>
                        </div>

                        <!-- Información principal de la oferta -->
                        <div class="flex flex-col p-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $joboffer->title }}</h3>
                                <div x-data="{ isOpen: @entangle('isOpen'), selectedJoboffer: null }" class="flex justify-between items-center">
                                    @if ($this->canApply($joboffer->id))
                                        <button wire:click.prevent="selectJobOffer({{ $joboffer->id }})"
                                            x-on:click.prevent="selectedJoboffer = {{ $joboffer->id }}; isOpen = true"
                                            class="flex items-center bg-white border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-300 ease-in-out">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus mr-1">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                <path d="M15 12h-6" />
                                                <path d="M12 9v6" />
                                            </svg>
                                            <span>Postular</span>
                                        </button>
                                    @endif

                                    @if ($isOpen)
                                        @include('joboffers.joboffer-pcreate', [
                                            'jobofferId' => 'selectedJoboffer',
                                        ])
                                    @endif
                                </div>
                            </div>

                            <!-- Descripción corta de la oferta -->
                            <p class="text-sm text-gray-600 line-clamp-3">{{ $joboffer->description }}</p>
                            <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span>{{ $joboffer->location }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z" />
                                    </svg>
                                    {{ $joboffer->type }}
                                </div>
                            </div>
                        </div>

                    </a>
                @endforeach

            </div>

            <!-- Paginación de las ofertas -->
            <div class="mt-6">
                {{ $joboffers->links() }}
            </div>

        </div>
    </div>
</div>
