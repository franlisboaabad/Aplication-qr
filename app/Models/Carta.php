<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;


    protected $fillable = [ 'nombre_empresa','slug','carta_path' ];


    
    
    public function getGetCartaAttribute()
    {
        if ($this->carta_path) {
            return url("storage/$this->carta_path");
        }
    }

}
