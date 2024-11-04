<div>
    <x-dialog-modal wire:model="isOpen">
      <x-slot name="title">
        <h3>Registro nuevos teacher</h3>
      </x-slot>
      <x-slot name="content">
        <form>
            <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                  <x-label value="grado academico del teacher" class="font-bold"/>
                  <x-input type="text" wire:model.defer="teacher.academic_degree" class="w-full"/>
                  <x-input-error for="teacher.academic_degree"/>
                </div>
              </div>

              <div class="flex justify-between mx-2 mb-6">
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                  <x-label value="especialidad del teacher" class="font-bold"/>
                  <x-input type="text" wire:model.defer="teacher.specialty" class="w-full"/>
                  <x-input-error for="teacher.specialty"/>
                </div>
              </div>

            <div class="mt-6">
                <x-label for="user" :value="__('correo electronico')" />
                <select id="user" class="block mt-1 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                     wire:model.defer="teacher.email" required>
                    <option value="">Seleccione el correo electronico </option>
                    @foreach ($users as $user)
                        <option value="{{ $user->email }}">{{ $user->email }}</option>
                    @endforeach
                </select>
                <x-input-error for="teacher.email" class="mt-2" />
            </div>

          <div class="mt-6">
            <x-label for="user" :value="__('Usuario')" />
            <select id="user" class="block mt-1 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                 wire:model.defer="teacher.user_id" required>
                <option value="">Selecione el Usuario asignado</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <x-input-error for="teacher.user_id" class="mt-2" />
          </div>

          <div class="mt-6">
            <x-label for="institution" :value="__('institution')" />
            <select id="institution" class="block mt-1 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                 wire:model.defer="teacher.institution_id" required>
                <option value="">Seleccione la institution asignada</option>
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                @endforeach
            </select>
            <x-input-error for="teacher.institution_id" class="mt-2" />
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
