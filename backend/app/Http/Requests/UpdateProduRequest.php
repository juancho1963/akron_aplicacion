<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'indice' => 'required|max:20|unique:produs,indice,'.$this->produ->id,
            'referencia' => 'required|max:20',
            'marca_id' => 'required',
            'descripcion' => 'required|max:255',
            'cantidad' => 'required|numeric',
            'precio'=> 'required|numeric',
            'descuento' => 'required|numeric',
            'foto'=> 'required|image|mimes:png,jpg,jpeg|max:2048',
            'foto2'=> 'image|mimes:png,jpg,jpeg|max:2000',
            'foto3'=> 'image|mimes:png,jpg,jpeg|max:2000',
            'foto4'=> 'image|mimes:png,jpg,jpeg|max:2000',

        ];
    }

    public function messages(): array
    {
        return [
            'indice.required' => 'El campo indice del producto es obligatorio.',
            'indice.max' => 'El indice del producto no puede tener mas de 20 caracteres.',
            'indice.unique' => 'El indice del producto ya esta registrado.',

            'referencia.required' => 'El campo referencia del producto es obligatorio.',
            'referencia.max' => 'La referencia del producto no puede tener mas de 20 caracteres.',
            'referencia.unique' => 'La referencia del producto ya esta registrada.',

            'marca_id.required'=> 'El campo marca es obligatorio.',

            'descripcion.required'=> 'El campo descripcion es obligatorio.',
            'descripcion.max'=> 'La descripcion no puede tener mas de 255 caracteres.',

            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.numeric' => 'La cantidad debe ser un numero.',

            'precio.required' => 'El campo precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un numero.',

            'descuento.required' => 'El campo descuento es obligatorio.',
            'descuento.numeric' => 'El descuento debe ser un numero.',

            'foto.required'=> 'La imagen de la foto es obligatoria',
            'foto.image'=> 'La imagen de la foto debe de ser una imagen.',
            'foto.mimes'=> 'La imagen de la foto debe de ser un archivo de tipo: png,jpg,jpeg.',
            'foto.max'=> 'La imagen de la foto no puede excedeer los 2MB.',

            'foto2.image'=> 'La segunda imagen debe de ser una imagen.',
            'foto2.mimes'=> 'La segunda imagen debe de ser un archivo de tipo: png,jpg,jpeg.',
            'foto2.max'=> 'La segunda imagen no puede excedeer los 2MB.',

            'foto3.image'=> 'La tercera imagensegunda imagen debe de ser una imagen.',
            'foto3.mimes'=> 'La tercera imagensegunda imagen debe de ser un archivo de tipo: png,jpg,jpeg.',
            'foto3.max'=> 'La tercera imagensegunda imagen no puede excedeer los 2MB.',

            'foto4.image'=> 'La cuarta imagentercera imagensegunda imagen debe de ser una imagen.',
            'foto4.mimes'=> 'La cuarta imagentercera imagensegunda imagen debe de ser un archivo de tipo: png,jpg,jpeg.',
            'foto4.max'=> 'La  cuarta imagentercera imagensegunda imagen no puede excedeer los 2MB.',
        ];
    }

}
