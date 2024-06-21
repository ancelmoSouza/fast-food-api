<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string'   => 'O campo nome deve ser uma string válida.',
            'name.max'      => 'O campo nome deve conter no máximo 255 caracteres.',

            'email.required' => 'O endereço de email é obrigatório.',
            'email.email'    => 'O endereço de email deve ser um endereço de email válido.',
            'email.unique'   => 'O endereço de email já está em uso.',

            'password.required' => 'A senha é um campo obrigatório.',
            'password.string'   => 'O campo senha deve ser uma string válida.',
            'password.min'      => 'O campo senha deve ter pelo menos 6 caracteres'
        ];
    }
}
