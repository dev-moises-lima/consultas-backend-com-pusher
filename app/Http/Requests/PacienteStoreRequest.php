<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use App\Rules\Foto;
use Illuminate\Foundation\Http\FormRequest;

class PacienteStoreRequest extends FormRequest
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
            'nome' => 'required|string|min:1',
            'cpf' => ['required', 'unique:pacientes,cpf', new Cpf],
            'data_de_nascimento' => "date|before:$data|required",
            'telefone' => 'string|required',
            'foto' => ['file', 'required', new Foto],
        ];
    }
}
