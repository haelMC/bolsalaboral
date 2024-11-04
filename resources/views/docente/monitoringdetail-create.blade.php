<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Registrar nuevo monitoreo</h3>
        </x-slot>
        <x-slot name="content">
            <form>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Recommendation" class="font-bold" />
                        <x-input type="text" wire:model.defer="monitoringdetail.recommendation" class="w-full" />
                        <x-input-error for="monitoringdetail.recommendation" />
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Description" class="font-bold" />
                        <x-input type="text" wire:model.defer="monitoringdetail.description" class="w-full" />
                        <x-input-error for="monitoringdetail.description" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-label class="block font-medium text-sm text-gray-700" for="birth_date">
                        Birth Date
                    </x-label>
                    <x-input wire:model.defer="monitoringdetail.date_monitoring" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="birth_date" type="date" name="birth_date" required="required" />
                    <x-input-error for="monitoringdetail.date_monitoring" />
                </div>
                <div>
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Monitoreo" class="font-bold"/>
                        <select wire:model.defer="monitoringdetail.monitoring_id" class="w-full">
                            <option value="">Selecciona un monitoring</option>
                            @foreach($monitorings as $monitoring)
                            @php
                                $graduate = null;
                                $teacher = null;

                                if ($monitoring->graduate_id) {
                                    $graduate = App\Models\Graduate::find($monitoring->graduate_id)->user;
                                }

                                if ($monitoring->teacher_id) {
                                    $teacher = App\Models\Teacher::find($monitoring->teacher_id)->user;
                                }
                            @endphp
                            <option value="{{ $monitoring->id }}">
                                Docente: {{ $teacher ? $teacher->name. ' ' .$teacher->paternal_last_name. ' ' .$teacher->maternal_last_name : 'Nombre no disponible' }}|
                                Egresado: {{ $graduate ? $graduate->name. ' ' .$graduate->paternal_last_name. ' ' .$graduate->maternal_last_name : 'Nombre no disponible' }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                </div>







            </form>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                Registrar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
