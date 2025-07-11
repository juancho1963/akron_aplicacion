<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comen extends Model
{
    use HasFactory;

    protected $fillable =['comenUser','respAdmin',
                            'estaComen','user_id'];

    public function user() {
        return $this->belongsTo(User::class);   //relacion 1 a muchos inversa
    }
}

