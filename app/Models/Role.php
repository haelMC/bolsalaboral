<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles'; // Nombre de la tabla en la base de datos
    protected $fillable = ['name']; // Atributos que puedes llenar
}
