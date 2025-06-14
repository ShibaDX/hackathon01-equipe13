<?php

require_once 'ApiNodeService.php';

class Inscricao
{
    public function inscrever(int $alunoId, int $eventoId)
    {
        $api = new ApiNodeService();

        $inscricao = [
            'aluno_id' => $alunoId,
            'evento_id' => $eventoId
        ];

        $resposta = $api->inscreverAluno($inscricao);

        return $resposta['code'];
    }

    public function desinscrever(int $id)
    {
        $api = new ApiNodeService();
        $inscricao = $api->desinscreverAluno($id);
    }

    public function listarInscricoesPorAluno(int $alunoId): array
    {
        $api = new ApiNodeService();
        return $api->listarInscricoesPorAluno($alunoId);
    }
}
