<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProduResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'id' => $this->id,
            'indice' => $this->indice,
            'referencia' => $this->referencia,
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'descuento' => $this->descuento,
            'marcas' => $this->marcas,
            'foto' => asset($this->foto),
        ];
    }
}
