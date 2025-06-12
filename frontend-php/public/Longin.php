<?php
require_once '../classes/Alunos.php';
require_once '../includes/bootstrap_css.php';
require_once '../includes/header.php';

$alunoService = new Alunos();
$erro = '';

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Em uma implementação real, isso seria validado com a API
    // Aqui estamos apenas simulando o login
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    // Simulação de login bem-sucedido
    if (!empty($email) && !empty($senha)) {
        session_start();
        $_SESSION['aluno_logado'] = true;
        $_SESSION['aluno_email'] = $email;
        header("Location: index.php");
        exit();
    } else {
        $erro = 'E-mail e senha são obrigatórios';
    }
} */
?>

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