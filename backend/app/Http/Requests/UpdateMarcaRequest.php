<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarcaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *  Obtenga las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array {
        return [
            'name' => 'required|max:255|unique:marcas,name,'.$this->marca->id,

        ];
    }
    // mesajes de error en reglas
    public function messages(): array {
        return [
            'name.required' => 'El campo nombre de la marca es obligatorio',
            'name.max' => 'El nombre de la marca no puede tener mas de 255 caracteres.',
            'name.unique' => 'El nombre de la marca ya esta registrado.',
        ];
    }
}
