<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     */
    public function index()
    {
          return view('admin.marcas.index')->with([
            'marcas' => Marca::latest()->get()
        ]);
    }

    /**
     *  Mostrar el formulario para crear un nuevo recurso.
     */
    public function create()
    {
       return view('admin.marcas.create');
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     */
    public function store(AddMarcaRequest $request)
    {
        if($request->validated()){ // valida los datos
            Marca::create($request->validated());
            return redirect()->route('admin.marcas.index')->with([
                'success' => 'La marca se ha creado correctamente.'
            ]);
        }
    }

    /**
     * Mostrar el recurso especificado.
     */
    public function show(Marca $marca)
    {
        abort(404);
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     */
    public function edit(Marca $marca)
    {
         return view('admin.marcas.edit')->with([
            'marca' => $marca
        ]);
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca)
    {
        if($request->validated()){
            $marca->update($request->validated());
            return redirect()->route('admin.marcas.index')->with([
                'success' => 'La marca se ha actualizado correctamente.'
            ]);
        }
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     */
    public function destroy(Marca $marca)
    {
       $marca->delete();
        return redirect()->route('admin.marcas.index')->with([
            'success' => 'La marca se ha eliminado correctamente.'
        ]);
    }
}
