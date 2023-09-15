<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            "edownload_url" => ["required"],
            "etitle" => ["required","min:3","max:150"],
            "edescription" => ["required","min:10","max:3000"],
            "user_id" => ["required"],
            "eyear" => ["required"]
        ];
    }

    public function messages(){
        return [
            "edownload_url.required" => "Por favor insira a url do documento",
            "etitle.required" => "Por favor insira o titulo",
            "etitle.min" => "O titulo deve ter no minimo :min caracteres",
            "etitle.max" => "O titulo deve ter no maximo :max caracteres",
             "edescription.required" => "A descricao deve ser preenchida",
             "edescription.min" => "A descricao deve ter no minimo :min caracteres",
             "edescription.max" => "A descricao deve ter no maximo :max caracteres",
             "user_id.required" => "Por favor indique o id do utilizador",
             "eyear.required" => "Por favor insira o ano"
        ];
    }
}
