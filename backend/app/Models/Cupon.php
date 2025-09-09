<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Iluminate\Support\Str;

class Cupon extends Model
{
    use HasFactory;

    protected $fillable = ['name','descuento','validoHasta'];

    public function serNameAttribute($value) {
        $this->attributes['name'] = Str::upper($value);
    }

    public function checkIfValid(){
        if($this->validoHasta > Carbon::now()){
            return true;
        }else{
            return false;
        }
    }
}
