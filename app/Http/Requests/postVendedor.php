<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postVendedor extends FormRequest
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
            "id_tdoc_usuario" => "required",
            "nombre" => "required",
            "email" => "required",
            "contraseña" => "required",
            "id_rol" => "required"
        ];
    }
}
