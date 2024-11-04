<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{

    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function graduates(){
        return $this->hasMany(Graduate::class);
    }
    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
}
