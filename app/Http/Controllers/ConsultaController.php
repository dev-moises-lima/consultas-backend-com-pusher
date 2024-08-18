<?php

namespace App\Http\Controllers;

use App\Events\ConsultaCadastrada;
use App\Http\Requests\ConsultaStoreRequest;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    //
    public function store(ConsultaStoreRequest $request, string $pacienteId)
    {
        if(is_null(Paciente::find($pacienteId))) {
            return response(['menssagem' => 'O paciente não existe', 404]);
        }

        $dados = $request->validated();

        $sintomas = json_decode($request->sintomas, true);
        $sintomasSentidos = 0;

        foreach ($sintomas as $sintoma) {
            if($sintoma) {
                ++$sintomasSentidos;
            }
        }

        $porcentagemDosSintomasSentidos = $sintomasSentidos / count($sintomas) * 100;

        $condicaoDoPaciente = match(true) {
            $porcentagemDosSintomasSentidos < 40 => 'Sintomas insuficientes',
            $porcentagemDosSintomasSentidos < 60 => 'Potencial infectado',
            default => $condicaoDoPaciente = 'Possível infectado'
        };

        $dados['condicao'] = $condicaoDoPaciente;
        $dados['paciente_id'] = $pacienteId;
        $dados['porcentagem_dos_sintomas_sentidos'] = $porcentagemDosSintomasSentidos;

        $consulta = Consulta::create($dados);
        $paciente = Paciente::find($pacienteId);
        $paciente->condicao_atual = $condicaoDoPaciente;
        $paciente->save();

        broadcast(new ConsultaCadastrada($consulta, $paciente))->toOthers();


        return response(['mensagem' => 'Consulta criada.', 'consulta' => $consulta, 'paciente' => $paciente], 201);
    }

}
