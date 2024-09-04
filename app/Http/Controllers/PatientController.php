<?php

namespace App\Http\Controllers;

use App\Events\PatientRegistered;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\PatientResource;
use Illuminate\Http\Request;
use App\Models\Patient;
use Intervention\Image\ImageManager;

class PatientController extends Controller
{
    //

    public function store(PatientStoreRequest $request)
    {
        $dados = $request->safe()->except(['photo']);

        $extensaoDaFoto = $request->photo->getClientOriginalExtension();
        $caminhoDaFoto = $request->photo->path();

        $imagemManager = ImageManager::gd()->read($caminhoDaFoto);
        $imagemManager->cover(300, 300);
        $nomeDaFoto = uniqid() . '.' . $extensaoDaFoto;
        $imagemManager->save(storage_path("app/public/photos/$nomeDaFoto"));

        $dados['photo'] = $nomeDaFoto;

        $patient = Patient::create($dados);
        $patientResource = new PatientResource($patient);

        broadcast(new PatientRegistered($patientResource))->toOthers();
        return $patientResource;
    }

    public function index()
    {
        return PatientResource::collection(Patient::all());
    }

    public function show(Patient $patient) {
        return new PatientResource($patient);
    }

    public function consultations(Patient $patient) {
        $consultations = $patient->consultations;

        return ConsultationResource::collection($consultations);
    }
}
