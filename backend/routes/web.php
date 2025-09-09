<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\MarcaController;
use App\Http\Controllers\Admin\ProduController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class,'login'])->name('admin.login');
Route::post('admin/auth', [AdminController::class,'auth'])->name('admin.auth');

Route::middleware('admin')->group(function() {
    Route::prefix('admin')->group(function(){
        Route::get('dashboard', [AdminController::class,'index'])->name('admin.index');
        Route::post('logout', [AdminController::class,'logout'])->name('admin.logout');

    // Rutas Marca
        Route::resource('marcas', MarcaController::class,[
            'names' =>[
                'index' => 'admin.marcas.index',
                'create' => 'admin.marcas.create',
                'store' => 'admin.marcas.store',
                'edit' => 'admin.marcas.edit',
                'update' => 'admin.marcas.update',
                'destroy' => 'admin.marcas.destroy',
            ]
        ]);

    // Rutas cupon
        Route::resource('cupons', CuponController::class,[
            'names' =>[
                'index' => 'admin.cupons.index',
                'create' => 'admin.cupons.create',
                'store' => 'admin.cupons.store',
                'edit' => 'admin.cupons.edit',
                'update' => 'admin.cupons.update',
                'destroy' => 'admin.cupons.destroy',
            ]
        ]);

    // Rutas Producto
        Route::resource('produs', ProduController::class,[
            'names' =>[
                'index' => 'admin.produs.index',
                'create' => 'admin.produs.create',
                'store' => 'admin.produs.store',
                'edit' => 'admin.produs.edit',
                'update' => 'admin.produs.update',
                'destroy' => 'admin.produs.destroy',
            ]
        ]);
    });
});
