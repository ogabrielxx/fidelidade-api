<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PontuarClienteRequest extends FormRequest
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
            'valor_gasto' => ['required','numeric']
        ];
    }

    public function messages()
    {
        return [
            'valor_gasto.required' => 'O campo valor_gasto é obrigatório.',
            'valor_gasto.numeric' => 'O campo valor_gasto deve ser um valor numérico.'
        ];
    }
}
