<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información del Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la información de perfil y la dirección de correo electrónico de tu cuenta.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Foto de Perfil -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div  x-data="{photoName: null, photoPreview: null}" class="rounded-3xl col-span-6 sm:col-span-6 shadow-inner bg-gradient-to-r from-white to-black  ">
                <!-- Input de Foto de Perfil -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('') }}" />

                <!-- Foto de Perfil Actual -->
                <div class="mt-2" x-show="! photoPreview">
                    @if (Auth::user()->profile_photo_path)
                        <img class="ml-3 h-50 w-50 rounded-full object-cover" src="/storage/{{Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <img class="ml-3 h-50 w-50 rounded-full object-cover" src="{{Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @endif
                </div>

                <!-- Previsualización de Nueva Foto de Perfil -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-40 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-3 mb-3 mr-2 ml-5" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleccionar una Foto') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2 ml-3 mr-2 mb-3" wire:click="deleteProfilePhoto">
                        {{ __('Eliminar Foto') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Nombre -->
        <div class="col-span-10 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Apellido Paterno -->
        <div class="col-span-10 sm:col-span-3">
            <x-label for="paternal_last_name" value="{{ __('Apellido Paterno') }}" />
            <x-input id="paternal_last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.paternal_last_name" autocomplete="paternal_last_name" />
            <x-input-error for="paternal_last_name" class="mt-2" />
        </div>

        <!-- Apellido Materno -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="maternal_last_name" value="{{ __('Apellido Materno') }}" />
            <x-input id="maternal_last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.maternal_last_name" autocomplete="maternal_last_name" />
            <x-input-error for="maternal_last_name" class="mt-2" />
        </div>

        <!-- DNI -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="dni" value="{{ __('DNI') }}" />
            <x-input id="dni" type="text" class="mt-1 block w-full" wire:model.defer="state.dni" autocomplete="dni" />
            <x-input-error for="dni" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="phone" value="{{ __('Teléfono') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" autocomplete="phone" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Estado Civil -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="civil_status" value="{{ __('Estado Civil') }}" />
            <x-select id="civil_status" class="mt-2 block w-full" wire:model.defer="state.civil_status">
                <option value="soltero">{{ __('Soltero') }}</option>
                <option value="casado">{{ __('Casado') }}</option>
                <option value="divorciado">{{ __('Divorciado') }}</option>
                <option value="viudo">{{ __('Viudo') }}</option>
            </x-select>
        </div>

        <!-- Género -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="gender" value="{{ __('Género') }}" />
            <x-select id="gender" class="mt-1 block w-full" wire:model.defer="state.gender">
                <option value="masculino">{{ __('Masculino') }}</option>
                <option value="femenino">{{ __('Femenino') }}</option>
                <option value="otros">{{ __('Otros') }}</option>
            </x-select>
            <x-input-error for="gender" class="mt-2" />
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="col-span-6 sm:col-span-5">
            <x-label for="birth_date" value="{{ __('Fecha de Nacimiento') }}" />
            <x-input id="birth_date" type="date" class="mt-1 block w-full" wire:model.defer="state.birth_date" autocomplete="off" />
            <x-input-error for="birth_date" class="mt-2" />
        </div>

        <!-- Email de Referencia -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="email_reference" value="{{ __('Email de Referencia') }}" />
            <x-input id="email_reference" type="email" class="mt-1 block w-full" wire:model.defer="state.email_reference" autocomplete="off" />
            <x-input-error for="email_reference" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-5">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full " wire:model.defer="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Tu dirección de correo electrónico no está verificada.') }}
                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Guardado.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
