<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
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
    public function rules()
    {
        return [
            'type'      => 'required|string|max:100',
            'length'    => 'required|string|in:M,G,P|max:1'
        ];
    }


    public function messages()
    {
        return [
            'type.required' => 'O tipo do produto é um campo obrigatório',
            'type.string'   => 'Tipo do produto deve ser uma string',
            'type.max'      => 'O campo tipo deve conter no máximo 100 caracteres',

            'lenght.required' => 'O campo tamanho do produto é obrigatório',
            'length.in'       => 'Um tamanho válido deve ser fornecido: (G) Grande, (M) Médio e (P) Pequeno',
            'length.string'   => 'O tamanho deve ser do tipo string',
            'length.max'      => 'O tamanho deve possuir uma das siglas padrões de tamanho no máximo 1: (G) Grande, (M) Médio e (P) Pequeno'
        ];
    }
    //X-Requested-With: XMLHttpRequest
}
