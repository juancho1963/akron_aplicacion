<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCuponRequest extends FormRequest
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
            'name' => 'required|max:255|unique:cupons',
            'descuento' => 'required',
            'validoHasta' => 'required'
        ];
    }
    // mesajes de error en reglas
    public function messages(): array {
        return [
            'name.required' => 'El campo nombre de la cupón es obligatorio',
            'name.max' => 'El nombre de la cupón no puede tener mas de 255 caracteres.',
            'name.unique' => 'El nombre de la cupón ya esta registrado.',
            'descuento.required' => 'El campo descuento es obligatorio',
            'validoHasta.required' => 'El campo fecha de validez es obligatorio',
        ];
    }
}
