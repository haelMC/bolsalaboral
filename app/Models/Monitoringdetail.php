<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoringdetail extends Model
{
    use HasFactory;
    protected $fillable=['recommendation','description','date_monitoring','monitoring_id'];
    public function monitoring(){
        return $this->belongsTo(Monitoring::class);
     }
}
