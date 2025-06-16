<?php

require_once 'ApiNodeService.php';

class Alunos
{

    public function __construct()
    {
        //$this->db = (new Database())->connect();
    }

    public function criarAluno($nome, $email, $senha, $telefone, $cpf)
    {
        $api = new ApiNodeService();

        $aluno = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'telefone' => $telefone,
            'cpf' => $cpf
        ];

        $resposta = $api->cadastrarAluno($aluno);

        if ($resposta['code'] === 201) {
            return true;
        } else {
            $mensagem = is_array($resposta['body']) && isset($resposta['body']['message'])
            ? $resposta['body']['message'] 
            : 'ERRO desconhecido ao cadastrar aluno.';
            throw new Exception($mensagem);// para debug
        }
    }

    public function buscarAluno(int $id)
    {
        $api = new ApiNodeService();
        $aluno = $api->buscarAluno($id);

        if ($aluno['code'] === 200) {
            echo "Nome do aluno: " . $aluno['body']['nome'];
        } else {
            echo "Aluno não encontrado.";
        }
    }

    public function verificarLogin($email, $senha)
    {
        $api = new ApiNodeService();

        $aluno = [
            'email' => $email,
            'senha' => $senha
        ];

        $resposta = $api->verificarLogin($aluno);

        if ($resposta['code'] === 200) {
            return $resposta;
        } else {
            $mensagem = is_array($resposta['body']) && isset($resposta['body']['message']) // para debug
            ? $resposta['body']['message']
            : 'Erro ao fazer login';

            throw new Exception($mensagem);
        }
    }

    /* public function atualizarUsuario($id, $nome, $email)
    {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'nome' => $nome,
            'email' => $email,
            'id' => $id
        ]);
    } */
}
