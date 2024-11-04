<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Storage;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],

            'paternal_last_name'=>['required','string', 'max:255'],
            'maternal_last_name'=>['required','string', 'max:255'],
            'dni'=>['required', 'string', 'max:8'],
            'civil_status'=>['required', 'in:soltero,casado,divorciado,viudo'],
            'phone'=>['required', 'string', 'max:250'],

            'birth_date'=>['required','date'],
            'gender'=>['nullable', 'in:masculino,femenino,otro'],
            'email_reference'=>['string','nullable','email'],


            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],

        ])->validateWithBag('updateProfileInformation');



       if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
            Storage::put('public/profile-photos', $input['photo']);

        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],

                'paternal_last_name' => $input['paternal_last_name'],
                'maternal_last_name'=>$input['maternal_last_name'],
                'dni'=>$input['dni'],
                'civil_status'=>$input['civil_status'],
                'phone'=>$input['phone'],


                'birth_date'=>$input['birth_date'],
                'gender'=>$input['gender'],
                'email_reference'=>$input['email_reference'],



            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],

            'paternal_last_name' => $input['paternal_last_name'],
            'maternal_last_name'=>$input['maternal_last_name'],
            'dni'=>$input['dni'],
            'civil_status'=>$input['civil_status'],
            'phone'=>$input['phone'],

            'birth_date'=>$input['birth_date'],
            'gender'=>$input['gender'],
            'email_reference'=>$input['email_reference'],


            'email' => $input['email'],
            'email_verified_at' => null,

        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
