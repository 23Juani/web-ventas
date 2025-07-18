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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $marca = $this->route('marca');
        $marcaId = $marca->caracteristica->id;

        return [
            'nombre' => 'required|max:100|unique:caracteristicas,nombre,' . $marcaId,
            'descripcion' => 'nullable|max:255',
        ];
    }
}
