<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produ extends Model
{
    use HasFactory;

    protected $fillable =['indice', 'referencia', 'descripcion',
                            'cantidad', 'precio', 'descuento',
                            'foto'];

    public function pedids() {
        return $this->belongsToMany(Pedid::class); //metodo mucho a muchos
    }

    public function marcas() {
        return $this->belongsToMany(Marca::class); //metodo mucho a muchos
    }

}
