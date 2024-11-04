<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class Postulation extends Model
{
    use HasFactory;

    protected $fillable = ['cv', 'score', 'status', 'graduate_id', 'joboffer_id'];

    // Mutador para guardar la ruta del archivo en lugar del archivo en sí
    public function setCvAttribute($value)
    {
        // Verificar si el valor es un archivo cargado (instancia de UploadedFile)
        if ($value instanceof UploadedFile) {
            $this->attributes['cv'] = $value->store('cv', 'public'); // Guardar el archivo y almacenar la ruta en el sistema de archivos público
        } else {
            $this->attributes['cv'] = $value; // Asignar la ruta almacenada si no es un archivo nuevo
        }
    }

    // Accesor para obtener la URL del archivo
    public function getCvUrlAttribute()
    {
        return Storage::url($this->cv);
    }

    // Relación con el modelo Graduate
    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }

    // Relación con el modelo Joboffer
    public function joboffer() // Cambiado a singular y belongsTo
    {
        return $this->belongsTo(Joboffer::class);
    }
}
