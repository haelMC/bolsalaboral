<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro de nuevos egresados</h3>
        </x-slot>
        <x-slot name="content">
            <form>
            <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Numero de Contacto" class="font-bold"/>
                        <x-input type="text" wire:model.defer="graduate.code" class="w-full"/>
                        <x-input-error for="graduate.code"/>
                    </div>
                </div>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Especialidad del egresado" class="font-bold"/>
                        <x-input type="text" wire:model.defer="graduate.specialty" class="w-full"/>
                        <x-input-error for="graduate.specialty"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Grado academico del egresado" class="font-bold"/>
                        <x-input type="text" wire:model.defer="graduate.academic_level" class="w-full"/>
                        <x-input-error for="graduate.academic_level"/>
                    </div>
                </div>

                <div class="mt-6">
                        <x-label for="user" :value="__('Usuario')" />
                        
                        <!-- Mostrar el nombre del usuario autenticado -->
                        <input id="user" type="text" 
                            class="block mt-1 w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            value="{{ auth()->user()->name }}" disabled>

                        <!-- Campo oculto para enviar el user_id del usuario autenticado -->
                        <input type="hidden" name="graduate[user_id]" value="{{ auth()->user()->id }}">

                        <x-input-error for="graduate.user_id" class="mt-2" />
                    </div>



                <div class="mt-6">
                    <x-label for="institution" :value="__('institution')" />
                    <select id="institution" class="block mt-1 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="graduate.institution_id" required>
                        <option value="">Seleccione la institución</option>
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="graduate.institution_id" class="mt-2" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
                Registrar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
