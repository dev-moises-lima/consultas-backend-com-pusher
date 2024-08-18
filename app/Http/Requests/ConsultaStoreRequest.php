<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaStoreRequest extends FormRequest
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
            'pressao_arterial_diastolica' => 'required|integer',
            'pressao_arterial_sistolica' => 'required|integer',
            'frequencia_cardiaca' => 'required|integer',
            'respiracao' => 'required|integer',
            'temperatura' => 'decimal:1|required',
            'sintomas' => 'required|json',
        ];
    }
}
