<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registro Nueva Postulación</h3>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="flex justify-lef mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Ingrese el Score" class="font-bold" />
                        <x-input type="number" wire:model.defer="postulation.score" class="w-full" />
                        <x-input-error for="postulation.score" />
                    </div>
                </div>
                <div class="flex justify-lef mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Ingrese el Status" class="font-bold" />
                        <select wire:model.defer="postulation.status" class="w-full rounded-lg">
                            @if ($ruteCreate)
                                <option value="" selected>Seleccione...</option>
                                <option value="accepted">Aceptado</option>
                                <option value="rejected">Rechazado</option>
                                <option value="pending">Pendiente</option>
                            @else
                                @if(is_object($postulation) && property_exists($postulation, 'status'))
                                    <option value="{{ $postulation->status }}" selected>{{ $postulation->status }}</option>
                                @else
                                    <option value="" selected>Seleccione un estado</option>
                                @endif
                                <option value="accepted">Aceptado</option>
                                <option value="rejected">Rechazado</option>
                                <option value="pending">Pendiente</option>
                            @endif
                        </select>
                        <x-input-error for="postulation.status" />
                    </div>
                </div>
                <div class="flex justify-lef mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label for="cv" value="Subir CV" class="font-bold" />
                        <x-input type="file" wire:model="cv" class="w-full" accept=".doc, .docx, .pdf" />
                        <x-input-error for="cv" />
                    </div>
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
