<?php

require_once 'ApiNodeService.php';

class Inscricao
{
    public function inscrever(int $alunoId, int $eventoId)
    {
        $api = new ApiNodeService();

        $inscricao = [
            'alunoId' => $alunoId,
            'eventoId' => $eventoId
        ];

        $resposta = $api->inscreverAluno($inscricao);

        if ($resposta['code'] === 201) {
            echo "Aluno inscrito com sucesso.";
        } else {
            echo "Erro ao inscrever aluno. Código: " . $resposta['code'];
            print_r($resposta['body']); // para debug
        }
    }

    public function desinscrever(int $id)
    {
        $api = new ApiNodeService();
        $inscricao = $api->desinscreverAluno($id);
    }
}
