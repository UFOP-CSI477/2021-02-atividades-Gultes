<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'initials' => 'required|max:2|min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.max' => 'O campo nome deve ter no máximo 100 caracteres',
            'initials.required' => 'O campo sigla é obrigatório',
            'initials.max' => 'O campo sigla deve ter no máximo 2 caracteres',
            'initials.min' => 'O campo sigla deve ter no mínimo 2 caracteres',
        ];
    }
}
