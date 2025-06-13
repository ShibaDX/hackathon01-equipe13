<?php

class ApiNodeService
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:3001';
        $this->apiKey = "reqres-free-v1";
    }

    private function request(string $endpoint, string $method = 'GET', array $data = []): array
    {
        $ch = curl_init($this->baseUrl . $endpoint);

        $headers = [
            'Content-Type: application/json',
            'x-api-key: ' . $this->apiKey
        ];
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
        ];

        if (in_array($method, ['POST', 'PUT'])) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'code' => $httpcode,
            'body' => json_decode($response, true)
        ];
    }

    //Aluno
    public function buscarAluno(int $id): array
    {
        return $this->request("/alunos/{$id}");
    }

    public function cadastrarAluno(array $aluno): array
    {
        return $this->request('/alunos', 'POST', $aluno);
    }

    public function verificarLogin(array $aluno): array
    {
        return $this->request('/session', 'POST', $aluno);
    }

    /*public function atualizarAluno(int $id, array $usuario): array
    {
        return $this->request("/aluno/{$id}", 'PUT', $usuario);
    }*/

    //Eventos
    public function listarEventos(): array
    {
        return $this->request('/eventos');
    }

    public function buscarEvento(int $id): array
    {
        return $this->request("/eventos/{$id}");
    }

    //Inscrição
    public function inscreverAluno(array $inscricao): array
    {
        return $this->request('/inscricoes', 'POST', $inscricao);
    }

    public function desinscreverAluno(int $id)
    {
        return $this->request("/inscricoes/{$id}", 'DELETE');
    }

    //Palestrante 
    public function buscarPalestrante(int $id): array
    {
        return $this->request("/palestrantes/{$id}");
    }
}
