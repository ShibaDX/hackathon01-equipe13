<?php
require_once '../classes/Alunos.php';
$aluno = new Alunos();
$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!empty($email) && !empty($senha)) {

        try {
            $login = $aluno->verificarLogin($email, $senha);
            if ($login['code'] === 200) {
                session_start();
                echo "Login realizado com sucesso";
                $_SESSION['aluno_logado'] = true;
                $_SESSION['aluno_id'] = $login['body']['aluno']['id'];
                $_SESSION['aluno_nome'] = $login['body']['aluno']['nome'];
                $_SESSION['aluno_email'] = $login['body']['aluno']['email'];
                $_SESSION['token'] = $login['body']['token'];
                echo $_SESSION['aluno_id'];
                header("Location: index.php");
                exit();
            } else {
                echo "Credenciais inseridas incorretas";
                echo $login['code'];
            }
        } catch (Exception $e) {
            $erro = 'Erro ao fazer login: ' . $e->getMessage();
        }
    } else {
        $erro = 'E-mail ou senha são obrigatórios';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once '../includes/bootstrap_css.php'; ?>
        <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require_once '../includes/header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-sign-in-alt"></i> Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($erro): ?>
                            <div class="alert alert-danger"><?= $erro ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt"></i> Entrar
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
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