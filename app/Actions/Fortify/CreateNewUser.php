<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return User
     */
    public function create(array $input): User
    {
        // Validación condicional según el tipo de registro (usuario o empresa)
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'paternal_last_name' => ['required_if:sol_status,usuario', 'nullable', 'string', 'max:255'], // Requerido solo si es usuario
            'maternal_last_name' => ['required_if:sol_status,usuario', 'nullable', 'string', 'max:255'], // Requerido solo si es usuario
            'dni' => ['required', 'string', 'max:255', 'unique:users'],
            'birth_date' => ['required_if:sol_status,usuario', 'nullable', 'date'], // Requerido solo si es usuario
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'sol_status' => ['required', 'in:empresa,usuario'], // Valida sol_status, debe ser "empresa" o "usuario"
            'gender' => ['nullable', 'in:masculino,femenino,otro'],
            'email_reference' => ['nullable', 'string', 'email'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Crear un nuevo usuario con los datos validados
        return User::create([
            'name' => $input['name'],
            'paternal_last_name' => $input['paternal_last_name'] ?? null, // Asigna null si no se proporciona
            'maternal_last_name' => $input['maternal_last_name'] ?? null, // Asigna null si no se proporciona
            'dni' => $input['dni'],
            'birth_date' => $input['birth_date'] ?? null, // Asigna null si no se proporciona
            'phone' => $input['phone'],
            'email' => $input['email'],
            'sol_status' => $input['sol_status'], // Guardar el valor de sol_status
            'gender' => $input['gender'] ?? null,
            'email_reference' => $input['email_reference'] ?? null,
            'password' => Hash::make($input['password']),
        ]);
    }

    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('sol_status')->default('usuario')->after('email'); // Puede ser 'usuario' o 'empresa'
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('sol_status');
    });
}

}
