<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResgatarPremioClienteRequest extends FormRequest
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
            'premio' => ['required','numeric']
        ];
    }

    public function messages()
    {
        return [
            'premio.required' => 'O campo premio é obrigatório.',
            'premio.numeric' => 'O campo premio deve ser um valor numérico.'
        ];
    }
}
