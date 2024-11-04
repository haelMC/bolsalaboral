<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens,HasFactory, HasProfilePhoto,Notifiable,TwoFactorAuthenticatable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'paternal_last_name',
        'maternal_last_name',
        'dni',
        'birth_date',
        'phone',
        'gender',
        'civil_status',
        'email_reference',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function graduate(){
        return $this->hasOne(Graduate::class);
    }
    public function teacher(){
        return $this->hasOne(Teacher::class);
    }
    public function company(){
        return $this->hasOne(Company::class);
    }
    public function institution(){
        return $this->hasOne(Institution::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function sendApprovalNotification()
    {
        $this->notify(new UsuarioAprobado());
    }

}
