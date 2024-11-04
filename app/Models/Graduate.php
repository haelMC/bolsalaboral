<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    protected $fillable=['code','specialty','academic_level', 'user_id', 'institution_id'];
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
    public function postulations(){
        return $this->hasMany(Postulation::class);
    }
}
