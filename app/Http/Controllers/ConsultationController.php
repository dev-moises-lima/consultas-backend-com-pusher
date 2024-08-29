<?php

namespace App\Http\Controllers;

use App\Events\RegisteredConsultation;
use App\Http\Requests\ConsultationStoreRequest;
use App\Http\Resources\PatientResource;
use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    //
    public function store(ConsultationStoreRequest $request, Patient $patient)
    {
        $dados = $request->validated();

        $sintomas = json_decode($request->sintomas, true);
        $percentageOfSymptomsFelt = count($sintomas) / 14 * 100;

        $condicaoDoPaciente = match(true) {
            $percentageOfSymptomsFelt < 40 => 'Sintomas insuficientes',
            $percentageOfSymptomsFelt < 60 => 'Potencial infectado',
            default => 'Possível infectado'
        };

        $dados['condition'] = $condicaoDoPaciente;
        $dados['patient_id'] = $patient->id;
        $dados['percentageOfSymptomsFelt'] = $percentageOfSymptomsFelt;

        $consultation = Consultation::create($dados);

        broadcast(new RegisteredConsultation($consultation, new PatientResource($patient)))->toOthers();

        return response()->json(['message' => 'Consulta criada.', 'consultation' => $consultation], 201);
    }

}
