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
        $senha = password_hash($senha, PASSWORD_BCRYPT);

        $aluno = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'telefone' => $telefone,
            'cpf' => $cpf
        ];

        $resposta = $api->cadastrarAluno($aluno);

        if ($resposta['code'] === 201) {
            echo "Aluno cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar aluno. Código: " . $resposta['code'];
            //print_r($resposta['body']); // para debug
        }
    }

    /*  public function validarLogin($email, $senha)
    {
        $sql = "SELECT id, nome, senha from usuarios WHERE email = :email";

        $query = $this->db->prepare($sql);
        $query->execute(['email' => $email]);

        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    } */

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
