<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'nombre_empresa','slug','carta_path','carta_path_actual' ];


    public function getGetDocumentoAttribute()
    {
        if ($this->carta_path) {
            return url("storage/$this->carta_path_actual");
        }
    }


}
