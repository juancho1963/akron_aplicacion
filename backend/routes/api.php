<?php

use App\Http\Controllers\Api\ProduController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('produs', [ProduController::class, 'index']);
Route::get('produs/{marca}/marca', [ProduController::class, 'filterProdusByMarca']);
Route::get('produs/{searchTerm}/find', [ProduController::class, 'filterProdusByTerm']);
Route::get('produs/{produ}/show', [ProduController::class, 'show']);
