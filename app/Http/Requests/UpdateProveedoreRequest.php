<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProveedoreRequest extends FormRequest
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
        $proveedore = $this->route('proveedore');
        return [
            'tipo_persona' => 'required|string',
            'razon_social' => 'required|max:80',
            'direccion' => 'required|max:80',
            'documento_id' => 'required|integer|exists:documentos,id',
            'numero_documento' => [
                'required',
                'max:20',
                Rule::unique('personas', 'numero_documento')
                    ->where('tipo_persona', $this->tipo_persona)
                    ->ignore($proveedore->persona->id),
            ],
        ];
    }
}
