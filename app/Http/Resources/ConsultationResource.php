<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'condition' => $this->condition,
            'diastolicBloodPressure' => $this->diastolicBloodPressure,
            'systolicBloodPressure' => $this->systolicBloodPressure,
            'heartRate' => $this->heartRate,
            'respiratoryRate' => $this->respiratoryRate,
            'temperature' => $this->temperature,
            'symptoms' => json_decode($this->symptoms),
            'percentageOfSymptomsFelt' => $this->percentageOfSymptomsFelt,
            'patient_id' => $this->patient_id,
            'created_at' => $this->created_at
        ];
    }
}
