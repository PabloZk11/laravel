<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class guardarrproductoRequest extends FormRequest
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
            "nom_producto" =>"required|unique:productos,nom_producto",
            "precio_unitario" => "required",
            "unidades_disponibles" => "required",
            "marca" => "required",
            "id_proveedor" => "required",
            "id_categoria" => "required"
        ];
    }
}
