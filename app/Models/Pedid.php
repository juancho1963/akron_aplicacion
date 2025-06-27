<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedid extends Model
{
    use HasFactory;

    protected $fillable = ['fechaPedido', 'fechaPagp', 'compPago',
                            'user_id', 'factu_id'];

    public function produs() {
        return $this->belongsToMany(Produ::class); //metodo mucho a muchos
    }

    public function user() {
        return $this->belongsTo(User::class); //uno a muchos inversa
    }

    public function factu() {
        return $this->belongsTo(Factu::class); //uno a uno
    }
}
