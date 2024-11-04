<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro de nuevas empresas</h3>
        </x-slot>
        <x-slot name="content">
            <form>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Nombre de la empresa" class="font-bold"/>
                        <x-input type="text" wire:model.defer="company.name" class="w-full"/>
                        <x-input-error for="company.name"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Descripción de la empresa" class="font-bold"/>
                        <x-input type="text" wire:model.defer="company.description" class="w-full"/>
                        <x-input-error for="company.description"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Ubicación de la empresa" class="font-bold"/>
                        <x-input type="text" wire:model.defer="company.location" class="w-full"/>
                        <x-input-error for="company.location"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Correo electrónico de la empresa" class="font-bold"/>
                        <x-input type="email" wire:model.defer="company.email" class="w-full"/>
                        <x-input-error for="company.email"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Dirección de la empresa" class="font-bold"/>
                        <x-input type="text" wire:model.defer="company.address" class="w-full"/>
                        <x-input-error for="company.address"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Teléfono de la empresa" class="font-bold"/>
                        <x-input type="text" wire:model.defer="company.phone" class="w-full"/>
                        <x-input-error for="company.phone"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Sector de la industria" class="font-bold"/>
                        <x-input type="text" wire:model.defer="company.industry_sector" class="w-full"/>
                        <x-input-error for="company.industry_sector"/>
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Años de actividad" class="font-bold"/>
                        <x-input type="number" wire:model.defer="company.years_of_activity" class="w-full"/>
                        <x-input-error for="company.years_of_activity"/>
                    </div>
                </div>

                <div class="mt-6">
                    <x-label for="user" :value="__('Usuario')" />
                    <select id="user" class="block mt-1 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            wire:model.defer="company.user_id" required>
                        <option value="">Seleccione el usuario</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="company.user_id" class="mt-2" />
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
