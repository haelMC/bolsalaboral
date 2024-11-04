<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('mayor_edad', function ($attribute, $value, $parameters, $validator) {
            $fechaNacimiento = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
            $edad = $fechaNacimiento->age;
            $mayorEdad = 18;
            return $edad >= $mayorEdad;
        });

    }
}
