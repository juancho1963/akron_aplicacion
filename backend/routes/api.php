<?php

use App\Http\Controllers\Api\CuponController;
use App\Http\Controllers\Api\PedidController;
use App\Http\Controllers\Api\ProduController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return [
            'user' => UserResource::make($request->user()),
            'access_token' => $request->bearerToken()
        ];
    });
    Route::post('user/logout', [UserController::class, 'logout']);
    Route::put('user/profile/update', [UserController::class, 'updateUserProfile']);



     //Ruta de los pedidos
    Route::post('store/pedid', [PedidController::class, 'store']);
    Route::post('pay/pedid', [PedidController::class, 'payPedidByStripe']);
    Route::post('pay/transf', [PedidController::class, 'payPedidByTransferencia']);

});

//Rutas productos
Route::get('produs', [ProduController::class, 'index']);
Route::get('produs/{marca}/marca', [ProduController::class, 'filterProdusByMarca']);
Route::get('produs/{searchTerm}/find', [ProduController::class, 'filterProdusByTerm']);
Route::get('produs/{produ}/show', [ProduController::class, 'show']);

//Rutas de los usuarios
Route::post('user/register', [UserController::class, 'store']);
Route::post('user/login', [UserController::class, 'auth']);

  //Ruta de los cupones
    Route::post('apply/cupon', [CuponController::class, 'applyCupon']);
