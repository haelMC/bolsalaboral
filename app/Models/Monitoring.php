<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable=['teacher_id','graduate_id'];
    use HasFactory;

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function graduate(){
       return $this->belongsTo(Graduate::class);
    }
    public function monitoringdetails(){
        return $this->hasMany(Monitoringdetail::class);
    }

}
