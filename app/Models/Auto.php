<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marca',
        'modelo',
        'slug',
        'anio',
        'color',
        'precio',
        'descripcion',
        'imagen_principal',
        'creado_en',
        'actualizado_en'
    ];

    public function getGetImagenAttribute()
    {
        if ($this->imagen_principal) {
            return url("storage/$this->imagen_principal");
        }
    }
    

}
