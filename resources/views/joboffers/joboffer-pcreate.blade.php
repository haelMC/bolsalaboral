<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro de Nueva Postulación</h3>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="store">
                <div class="flex justify-left mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="CV" class="font-bold" />
                        <!-- Utilizamos input type="file" para permitir la selección de archivos -->
                        <input type="file" wire:model="cv" class="w-full">
                        <x-input-error for="cv" />
                    </div>
                </div>
                <input type="hidden" wire:model="postulation.joboffer_id" value="{{ $jobofferId }}">

                <!-- Botones del formulario -->
                <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2">Cancelar</x-secondary-button>
                <x-button type="submit" wire:loading.attr="disabled" wire:target="cv, store" class="disabled:opacity-25">
                    Registrar
                </x-button>
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
