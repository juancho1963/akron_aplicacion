<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function applyCupon(Request $request)
    {
        $cupon = Cupon::whereName($request->name)->first();
        if($cupon && $cupon->checkIfValid()){
            return response()->json([
                'message' => 'El cupón ha sido aplicado exitosamente.',
                'cupon' => $cupon
            ]);
        }else {
            return response()->json([
                'error' => 'El cupón ingresado no es válido o ha expirado.'
            ]);
        }
    }
}
