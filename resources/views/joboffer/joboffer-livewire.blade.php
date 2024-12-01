<div>
    <!-- Sección de ofertas de trabajo -->
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <h2 class="text-3xl font-extrabold text-center text-blue-800 mb-2">
                    Descubre Oportunidades Laborales Únicas
                </h2>
                <p class="text-center text-gray-600 mb-6 text-lg">
                    Encuentra la posición que has estado buscando. Revisa cada oferta para conocer los detalles y postúlate directamente.
                </p>

                <!-- Grid de tarjetas de ofertas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach ($joboffers as $joboffer)
                        <div class="flex flex-col relative shadow-2xl rounded-b-lg">
                            <div class="flex flex-col p-4">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $joboffer->title }}</h3>
                                <p class="text-sm text-gray-600 line-clamp-3">{{ $joboffer->description }}</p>
                                <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                                    <button wire:click.prevent="selectJobOffer({{ $joboffer->id }})"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
                                        Postular
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-6">
                    {{ $joboffers->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if ($isOpen)
        <x-dialog-modal wire:model="isOpen">
            <x-slot name="title">
                <h3>Registro de Nueva Postulación</h3>
            </x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="store">
                    <div class="mb-4">
                        <x-label value="CV" />
                        <input type="file" wire:model="cv" class="block mt-1 w-full">
                        @error('cv') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <input type="hidden" wire:model="selectedJoboffer">
                    <x-secondary-button wire:click="$set('isOpen', false)">Cancelar</x-secondary-button>
                    <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
                        Registrar
                    </button>

                </form>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
