<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3 class="text-xl font-bold">Registro nuevo Trabajo</h3>
        </x-slot>
        <x-slot name="content">
            <form method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-label value="Titulo" class="font-bold" />
                        <x-input type="text" wire:model.defer="joboffer.title" class="w-full" />
                        <x-input-error for="joboffer.title" />
                    </div>
                    <div>
                        <x-label value="Descripcion" class="font-bold" />
                        <x-input type="text" wire:model.defer="joboffer.description" class="w-full" />
                        <x-input-error for="joboffer.description" />
                    </div>
                    <div>
                        <x-label value="Tipo" class="font-bold" />
                        <x-input type="text" wire:model.defer="joboffer.type" class="w-full" />
                        <x-input-error for="joboffer.type" />
                    </div>
                    <div>
                        <x-label value="Ubicación" class="font-bold" />
                        <x-input type="text" wire:model.defer="joboffer.location" class="w-full" />
                        <x-input-error for="joboffer.location" />
                    </div>
                    <div>
                        <x-label value="Salario" class="font-bold" />
                        <x-input type="text" wire:model.defer="joboffer.salary" class="w-full" />
                        <x-input-error for="joboffer.salary" />
                    </div>
                    <div>
                        <x-label value="Fecha de inicio" class="font-bold" />
                        <x-input type="date" wire:model.defer="joboffer.start_date" class="w-full" />
                        <x-input-error for="joboffer.start_date" />
                    </div>
                    <div>
                        <x-label value="Fecha de fin" class="font-bold" />
                        <x-input type="date" wire:model.defer="joboffer.end_date" class="w-full" />
                        <x-input-error for="joboffer.end_date" />
                    </div>
                    <div>
                        <x-label value="Experiencia requerida" class="font-bold" />
                        <x-input type="text" wire:model.defer="joboffer.experience_required" class="w-full" />
                        <x-input-error for="joboffer.experience_required" />
                    </div>
                    <div>
                        <x-label value="Detalles de contacto" class="font-bold" />
                        <x-input type="text" wire:model.defer="joboffer.contact_details" class="w-full" />
                        <x-input-error for="joboffer.contact_details" />
                    </div>
                    <div>
                        <x-label value="Estado" class="font-bold" />
                        <select id="status"
                            class="block w-full rounded-md py-3 px-4 pr-8 bg-gray-200 border border-gray-200 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            wire:model.defer="joboffer.status">
                            <option value="">Seleccionar estado</option>
                            <option value="1">Borrado</option>
                            <option value="2">Publicado</option>
                        </select>
                        <x-input-error for="joboffer.status" class="mt-2" />
                    </div>

                    <div>
                        <x-label value="Categoría" class="font-bold" />
                        <select id="category"
                            class="block w-full rounded-md py-3 px-4 pr-8 bg-gray-200 border border-gray-200 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            wire:model.defer="joboffer.category_id" required>
                            <option value="">Seleccionar categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="joboffer.category_id" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="profile_image" :value="__('Imagen Para la oferta')" class="font-bold" />
                        <div class="rounded-md">
                            <!-- Mostrar la imagen de perfil del usuario -->
                            @if (Auth::user()->profile_photo_path)
                                <img src="/storage/{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" class="mt-2 rounded w-24 h-24 object-cover">
                            @else
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="mt-2 rounded w-24 h-24 object-cover">
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store, image"
                class="disabled:opacity-25">
                Registrar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
