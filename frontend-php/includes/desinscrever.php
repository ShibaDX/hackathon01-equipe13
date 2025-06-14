<?php
session_start();
require_once '../classes/Inscricao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['inscricao_id'] ?? null;

    if ($id) {
        $inscricao = new Inscricao();
        $inscricao->desinscrever((int) $id);
    }
}

// Redireciona de volta para o perfil
header('Location: ../public/perfilAluno.php');
exit;
