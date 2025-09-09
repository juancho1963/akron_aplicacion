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

                if($request->has('foto2')){
                    $data['foto2'] = $this->saveImage($request->file('foto2'));
                }

                if($request->has('foto3')){
                    $data['foto3'] = $this->saveImage($request->file('foto3'));
                }

                if($request->has('foto4')){
                    $data['foto4'] = $this->saveImage($request->file('foto4'));
                }

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
                $old_image = $produ::where('indice', $data['indice'])->first()->foto;
                $this->removeProduImageFromStorage($request->file('foto'));
 /*              $this->removeProductoImageFromStorage($request->file('foto')); // original */
                $data['foto'] = $this->saveImage($request->file('foto'));
            }

            if($request->has('foto2')){
                $old_image = $produ::where('indice', $data['indice'])->first()->foto2;
                $this->removeProduImageFromStorage($old_image);
               /*  $this->removeProductoImageFromStorage($request->file('foto2')); */
                $data['foto2'] = $this->saveImage($request->file('foto2'));
            }

            if($request->has('foto3')){
                $old_image = $produ::where('indice', $data['indice'])->first()->foto3;
                $this->removeProduImageFromStorage($old_image);
           /*      $this->removeProductoImageFromStorage($request->file('foto3')); */
                $data['foto3'] = $this->saveImage($request->file('foto3'));
            }

            if($request->has('foto4')){
                $old_image = $produ::where('indice', $data['indice'])->first()->foto4;
                $this->removeProduImageFromStorage($old_image);
            /*     $this->removeProductoImageFromStorage($request->file('foto4')); */
                $data['foto4'] = $this->saveImage($request->file('foto4'));
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
        $this->removeProduImageFromStorage($produ->foto2);
        $this->removeProduImageFromStorage($produ->foto3);
        $this->removeProduImageFromStorage($produ->foto4);

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

