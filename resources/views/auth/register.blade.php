<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex items-center justify-center mx-auto m-1">
                <x-authentication-card-logo />
                <h2 class="text-2xl lg:text-3xl ml-2">Regístrate</h2>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Selección de tipo de registro -->
            <div class="mt-4">
                <x-label for="sol_status" value="{{ __('Tipo de registro') }}" />
                <select id="sol_status" name="sol_status" class="block mt-1 w-full" required onchange="toggleFormFields()">
                    <option value="usuario">{{ __('Usuario') }}</option>
                    <option value="empresa">{{ __('Empresa') }}</option>
                </select>
            </div>
            
            <!-- Nombre -->
            <div>
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            </div>



            <!-- Campos solo para USUARIO -->
            <div id="usuario_fields">
                <div class="flex justify-between mt-4">
                    <div class="w-1/2 mr-4">
                        <x-label for="paternal_last_name" value="{{ __('Apellido paterno') }}" />
                        <x-input id="paternal_last_name" class="block mt-1 w-full" type="text" name="paternal_last_name" value="{{ old('paternal_last_name') }}" />
                    </div>

                    <div class="w-1/2">
                        <x-label for="maternal_last_name" value="{{ __('Apellido materno') }}" />
                        <x-input id="maternal_last_name" class="block mt-1 w-full" type="text" name="maternal_last_name" value="{{ old('maternal_last_name') }}" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-label for="birth_date" value="{{ __('Fecha de Nacimiento') }}" />
                    <x-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" value="{{ old('birth_date') }}" />
                </div>
            </div>

            <!-- Campo dinámico para DNI o RUC -->
            <div class="mt-4">
                <x-label for="dni_ruc" id="dni_ruc_label" value="{{ __('DNI') }}" />
                <x-input id="dni_ruc" class="block mt-1 w-full" type="text" name="dni" value="{{ old('dni') }}" required />
            </div>

            <!-- Campo común para ambos (Usuario y Empresa) -->
            <div class="mt-4">
                <x-label for="phone" value="{{ __('Celular') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" value="{{ old('phone') }}" required />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirma Contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('¿Ya estas registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Regístrate') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<script>
    function toggleFormFields() {
        var solStatus = document.getElementById('sol_status').value;
        var usuarioFields = document.getElementById('usuario_fields');
        var dniRucLabel = document.getElementById('dni_ruc_label');

        if (solStatus === 'empresa') {
            usuarioFields.style.display = 'none'; // Ocultar campos de usuario
            dniRucLabel.innerHTML = 'RUC'; // Cambiar el label a RUC
        } else {
            usuarioFields.style.display = 'block'; // Mostrar campos de usuario
            dniRucLabel.innerHTML = 'DNI'; // Cambiar el label a DNI
        }
    }

    // Ejecutar la función al cargar la página para mostrar el formulario correcto
    document.addEventListener('DOMContentLoaded', toggleFormFields);
</script>
