<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'string|max:255',
            'email' => 'email|unique:users'
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'   => 'O campo nome deve ser uma string válida.',
            'name.max'      => 'O campo nome deve conter no máximo 255 caracteres.',

            'email.email'    => 'O endereço de email deve ser um endereço de email válido.',
            'email.unique'   => 'O endereço de email já está em uso.',
        ];
    }
}
