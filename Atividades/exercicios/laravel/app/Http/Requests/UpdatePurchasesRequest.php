<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchasesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'person_id' => 'required|exists:people,id',
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'person_id.required' => 'O campo pessoa é obrigatório',
            'person_id.exists' => 'O campo pessoa deve ser válido',
            'product_id.required' => 'O campo produto é obrigatório',
            'product_id.exists' => 'O campo produto deve ser válido',
        ];
    }
}
