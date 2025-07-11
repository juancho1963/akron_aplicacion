<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factu extends Model
{
    use HasFactory;

    protected $fillable = ['numFactura','fechaFactura','nameUser',
                            'docIdenUser','direcUser','numTelefoUser']; //atributos de la tabla

}
