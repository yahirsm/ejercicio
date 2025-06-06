<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

   
    protected $fillable = ['clave', 'nombre']; 

    public function materiales()
    {
        return $this->hasMany(Material::class);
    }
}

