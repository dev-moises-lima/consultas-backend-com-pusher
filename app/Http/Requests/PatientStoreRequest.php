<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use App\Rules\Foto;
use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
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
        date_default_timezone_set("America/Sao_Paulo");
        $data = date('Y-m-d');

        return [
            'name' => 'required|string|min:1',
            'cpf' => ['required', 'unique:patients,cpf', new Cpf],
            'dateOfBirth' => "date|before:$data|required",
            'telephone' => 'string|required',
            'photo' => ['file', 'required', new Foto],
        ];
    }
}