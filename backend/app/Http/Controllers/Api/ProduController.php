<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProduResource;
use App\Models\Marca;
use App\Models\Produ;
use Illuminate\Http\Request;

class ProduController extends Controller
{
    public function index() {
        return ProduResource::collection(Produ::with(['marcas'])->latest()->get())
            ->additional([
                'marcas' => Marca::has('produs')->get(),
            ]);
    }

    public function show(Produ $produ) {
        if(!$produ) {
            abort(404);
        }
        return ProduResource::make(
            $produ->load(['marcas'])
        );
    }

    public function filterProdusByMarca(Marca $marca) {
        return ProduResource::collection(
            $marca->produs()->with(['marcas'])->latest()->get())
            ->additional([
                'marcas' => Marca::has('produs')->get(),
            ]);
    }

    public function filterProdusByTerm($searchTerm) {
        return ProduResource::collection(
            Produ::where('descripcion','LIKE','%'.$searchTerm.'%')
            ->with(['marcas'])->latest()->get())
            ->additional([
                'marcas' => Marca::has('produs')->get(),
            ]);
    }
}
