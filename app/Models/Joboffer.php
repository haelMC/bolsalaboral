<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joboffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'type',
        'location',
        'salary',
        'start_date',
        'end_date',
        'experience_required',
        'contact_details',
        'status',
        'company_id',
        'category_id',
        'user_id'
    ];
    public function postulations()
    {
        return $this->hasMany(Postulation::class);
    }
     
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
