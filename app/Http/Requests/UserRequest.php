<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            "name" => ["required","min:3","max:150"],
            "password" => ["required","min:6","max:15"],
            "email" => ["required","email"]
        ];
    }

    public function messages() {
        return [
            "name.required" => "Por favor preencha o nome",
            "name.min" => "O nome deve ter no minimo :min caracteres",
            "name.max" => "O nome deve ter no maximo :max caracteres",
            "password.required" => "Por favor preencha a senha",
            "password.min" => "A senha deve ter no minimo :min caracteres",
            "password.max" => "A senha deve ter no maximo :max caracteres",
            "email.email" => "O email deve ser valido",
            "email.required" => "O email deve ser preenchido"     
        ];
    }
}
