<?php

namespace App\Http\Controllers;

use App\Events\RegisteredConsultation;
use App\Events\UpdatedPatient;
use App\Http\Requests\ConsultationStoreRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\PatientResource;
use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(ConsultationStoreRequest $request, Patient $patient)
    {
        $dados = $request->validated();

        $symptoms = json_decode($dados['symptoms'], true);
        $percentageOfSymptomsFelt = count($symptoms) / 14 * 100;

        $patientCondition = match(true) {
            $percentageOfSymptomsFelt < 40 => 'Sintomas insuficientes',
            $percentageOfSymptomsFelt < 60 => 'Potencial infectado',
            default => 'Possível infectado'
        };

        $dados['condition'] = $patientCondition;
        $dados['patient_id'] = $patient->id;
        $dados['percentageOfSymptomsFelt'] = $percentageOfSymptomsFelt;

        $consultation = Consultation::create($dados);

        broadcast(new RegisteredConsultation(new ConsultationResource($consultation), new PatientResource($patient)))->toOthers();
        broadcast(new UpdatedPatient(new PatientResource($patient)))->toOthers();

        return new ConsultationResource($consultation);
    }
}
