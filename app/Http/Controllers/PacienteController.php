<?php

namespace App\Http\Controllers;

use App\Events\PacienteCadastrado;
use App\Http\Requests\PacienteStoreRequest;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Rules\Cpf;
use Intervention\Image\ImageManager;

class PacienteController extends Controller
{
    //

    public function store(PacienteStoreRequest $request)
    {
        $dados = $request->safe()->except(['foto']);

        $extensaoDaFoto = $request->foto->getClientOriginalExtension();
        $caminhoDaFoto = $request->foto->path();

        $imagemManager = ImageManager::gd()->read($caminhoDaFoto);
        $imagemManager->cover(300, 300);
        $nomeDaFoto = uniqid() . '.' . $extensaoDaFoto;
        $imagemManager->save("../storage/app/public/imagens/$nomeDaFoto");
        $novoCaminhoDaFoto = asset('storage/imagens/' . $nomeDaFoto);

        $dados['foto'] = $novoCaminhoDaFoto;

        $paciente = Paciente::create($dados);
        broadcast(new PacienteCadastrado($paciente))->toOthers();

        return response(['mensagem' => 'Paciente cadastrado.', 'paciente' => $paciente], 201);
    }

    public function obterTodos()
    {
        return Paciente::all();
    }

    public function obterUm(Request $request, string $pacienteId) {
        $paciente = Paciente::find($pacienteId);

        if(empty($paciente)) {
            return response(['mensagem' => "Paciente com o id {$pacienteId} não foi encontrado"], 400);
        }

        return $paciente;
    }

    public function obterConsultas(Request $request, string $pacienteId) {
        $paciente = Paciente::find($pacienteId);

        if(is_null($paciente)) {
            return response(['mensagem' => 'As consultas para um paciente não cadastrado não existem.'], 404);
        }

        $consultas = $paciente->consultas;

        return $consultas;
    }
}
