<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lastConsutation = $this->consultations()->first();

        return [
            "id" => $this->id,
            "name" => $this->name,
            "cpf" => $this->cpf,
            "telephone" => $this->telephone,
            "dateOfBirth" => $this->dateOfBirth,
            "currentCondition" => $lastConsutation?->condition,
            "photoUrl" => asset("storage/photos/{$this->photo}"),
        ];
    }
}