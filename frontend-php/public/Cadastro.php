<?php
require_once '../classes/Alunos.php';

$alunoService = new Alunos();
$sucesso = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $cpf = $_POST['cpf'] ?? '';

    try {
        // Chamada para a API Node.js
        $alunoService->criarAluno($nome, $email, $senha, $telefone, $cpf);
        $sucesso = 'Cadastro realizado com sucesso! Faça login para continuar.';
    } catch (Exception $e) {
        $erro = 'Erro ao cadastrar: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../includes/bootstrap_css.php'; ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro</title>
</head>

<body>
    <?php require_once '../includes/header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user-plus"></i> Cadastro de Aluno</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($sucesso): ?>
                            <div class="alert alert-success"><?= $sucesso ?></div>
                        <?php endif; ?>

                        <?php if ($erro): ?>
                            <div class="alert alert-danger"><?= $erro ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nome" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="senha" name="senha" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone" name="telefone" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save"></i> Cadastrar
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once '../includes/footer.php';
    require_once '../includes/bootstrap_js.php';
    ?>

</body>

</html>