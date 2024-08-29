<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationStoreRequest extends FormRequest
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
            'diastolicBloodPressure' => 'required|integer',
            'systolicBloodPressure' => 'required|integer',
            'heartRate' => 'required|integer',
            'respiratoryRate' => 'required|integer',
            'temperature' => 'decimal:1|required',
            'symptoms' => 'required|json',
        ];
    }
}
