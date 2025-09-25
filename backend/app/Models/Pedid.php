<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedid extends Model
{
    use HasFactory;

    protected $fillable = ['fechaPedido', 'nameCupon', 'descuentoCupon', 'fechaPagp', 'compPago',
                            'user_id', 'cupon_id', 'statusped', 'numTelefoUser',
                             'direcUser','docIdenUser', 'nameUser', 'fechaFactura', 'numFactura','montoTotalPed'];

    public function produs() {
        return $this->belongsToMany(Produ::class); //metodo mucho a muchos
    }

    public function user() {
        return $this->belongsTo(User::class); //uno a muchos inversa
    }

}
