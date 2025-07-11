<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\AddProduRequest;
use App\Http\Requests\UpdateProduRequest;
use App\Models\Marca;
use App\Models\Produ;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProduController extends Controller
{
      /**
     * Mostrar una lista del recurso.
     */
    public function index()
    {
        return view('admin.produs.index')->with([
            'produs' => Produ::with(['marcas'])->latest()->get()
        ]);
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $marcas = Marca::all();  //importa la lista de marcas disponibles
        return view('admin.produs.create')->with([
            'marcas'=> $marcas,   //envia el arreglo de las marcas
        ]);
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     */
    public function store(AddProduRequest $request)
    {
            //$datosProduct = $request->all();
            //return response()-> json($datosProduct);

            if($request->validated()){
                $data = $request->all(); //recupera los datos del formulario
                $data['foto'] = $this->saveImage($request->file('foto'));

              //  $data['slug'] = Str::slug($request->indice);

                $produ = Produ::create($data);
                $produ->marcas()->sync($request->marca_id);

                return redirect()->route('admin.produs.index')->with([
                'success' => 'El producto se ha creado correctamente.'
                ]);
            }


    }

    /**
     * Mostrar el recurso especificado.
     */
    public function show(Produ $produ)
    {
        abort(404);
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     */
    public function edit(Produ $produ)
    {
        $marcas = Marca::all();
        return view('admin.produs.edit')->with([
            'marcas'=> $marcas,
            'produ'=> $produ
        ]);
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     */
    public function update(UpdateProduRequest $request, Produ $produ)
    {
        if($request->validated()){
            $data = $request->all();

            if ($request->has('foto')){
                $this->removeProduImageFromStorage($request->file('foto'));
                $data['foto'] = $this->saveImage($request->file('foto'));
            }

  /*           $data['slug'] = Str::slug($request->name); */

            $produ->update($data);
            $produ->marcas()->sync($request->marca_id);

            return redirect()->route('admin.produs.index')->with([
            'success' => 'El producto se ha actualizado correctamente.'
            ]);
        }
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     */
    public function destroy(Produ $produ)
    {
        $this->removeProduImageFromStorage($produ->foto);

        $produ->delete();
        return redirect()->route('admin.produs.index')->with([
            'success' => 'El producto se ha eliminado correctamente.'
        ]);
    }

    public function saveImage($file) {
        $image_name = time().'_'.$file->getClientOriginalName();
        $file->storeAs('images/produs/', $image_name, 'public');
        return 'storage/images/produs/'.$image_name;
    }

    Public function removeProduImageFromStorage($file) {
        $path = public_path('storage/images/produs'.$file);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

}

