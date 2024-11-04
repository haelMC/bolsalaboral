<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable=['academic_degree','specialty','email','user_id', 'institution_id'];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function monitorings(){
        return $this->hasMany(Monitoring::class);
    }
    public function institution(){
        return $this->belongsTo(Institution::class);
    }
}
