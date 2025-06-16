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
        // Cria a requisição com a URL base da API + o endpoint específico (alunos, eventos, inscricao)
        $ch = curl_init($this->baseUrl . $endpoint);

        //Define o Content-Type como JSON
        $headers = [
            'Content-Type: application/json',
            'x-api-key: ' . $this->apiKey
        ];
        $options = [
            CURLOPT_RETURNTRANSFER => true, // Faz o curl_exec retornar a resposta como string
            CURLOPT_CUSTOMREQUEST => $method, // Define o método HTTP (GET, POST, PUT etc.)
            CURLOPT_HTTPHEADER => $headers, // Adiciona os headers
        ];

        // Se o método for POST ou PUT, envia os dados como JSON no corpo da requisição
        if (in_array($method, ['POST', 'PUT'])) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        // Envia a requisição com as opções configuradas
        curl_setopt_array($ch, $options);

        // Armazena o corpo da resposta
        $response = curl_exec($ch);

        // Armazena o código de status HTTP da resposta (ex: 200, 201, 404) 
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Fecha a conexão cURL
        curl_close($ch);

        // Retorna um array com o status HTTP e o corpo da resposta
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

    public function listarInscricoesPorAluno(int $alunoId): array
    {
        return $this->request("/inscricoes/aluno/{$alunoId}");
    }

    //Palestrante 
    public function buscarPalestrante(int $id): array
    {
        return $this->request("/palestrantes/{$id}");
    }
}
