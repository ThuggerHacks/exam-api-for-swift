<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            "fsubject" => ["required","min:5","max:100"],
            "fmessage" => ["required","min:5","max:3000"],
        ];
    }

    public function messages(){

        return [
            "fsubject.required" => "Por favor preencha o assunto",
            "fsubject.min" => "O assunto deve ter pelomenos :min caracteres",
            "fsubject.max" => "O assunto deve ter ate :max caracteres",
            "fmessage.required" => "Por favor preencha a mensagem",
            "fmessage.min" => "A mensagem deve ter pelomenos :min caracteres",
            "fmessage.max" => "A mensagem deve ter no maximo :max caracteres"    
        ];
    }
}
