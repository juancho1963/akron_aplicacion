<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCuponRequest;
use App\Http\Requests\UpdateCuponRequest;
use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     */
    public function index()
    {
          return view('admin.cupons.index')->with([
            'cupons' => Cupon::latest()->get()
        ]);
    }

    /**
     *  Mostrar el formulario para crear un nuevo recurso.
     */
    public function create()
    {
       return view('admin.cupons.create');
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     */
    public function store(AddCuponRequest $request)
    {
        if($request->validated()){ // valida los datos
            Cupon::create($request->validated());
            return redirect()->route('admin.cupons.index')->with([
                'success' => 'El cupón se ha creado correctamente.'
            ]);
        }
    }

    /**
     * Mostrar el recurso especificado.
     */
    public function show(Cupon $cupon)
    {
        abort(404);
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     */
    public function edit(Cupon $cupon)
    {
         return view('admin.cupons.edit')->with([
            'cupon' => $cupon
        ]);
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     */
    public function update(UpdateCuponRequest $request, Cupon $cupon)
    {
        if($request->validated()){
            $cupon->update($request->validated());
            return redirect()->route('admin.cupons.index')->with([
                'success' => 'El cupón se ha actualizado correctamente.'
            ]);
        }
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     */
    public function destroy(Cupon $cupon)
    {
       $cupon->delete();
        return redirect()->route('admin.cupons.index')->with([
            'success' => 'El cupón se ha eliminado correctamente.'
        ]);
    }
}
