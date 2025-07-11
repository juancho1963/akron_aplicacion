<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['name']; //atributos de la tabla

    public function produs() { //metodo (funcion) publica por tablas
        return $this->belongsToMany(Produ::class);  //por models relacion muchos a muchos entre Marca y Produ

    }
}
