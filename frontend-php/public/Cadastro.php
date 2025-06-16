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
        // chamada para a API Node.js
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
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
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

                        <form method="POST" id="form_cad">
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
                                    <input type="password" class="form-control" id="senha" name="senha" minlength="8" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone" name="telefone" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" minlength="14" maxlength="14" required>
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
    <!-- biblioteca JS para aplicar máscaras em inputs -->
    <script src="https://unpkg.com/imask"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // validador de CPF
            function validarCPF(cpf) {
                cpf = cpf.replace(/[^\d]+/g, '');

                if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

                let soma = 0;
                for (let i = 0; i < 9; i++) {
                    soma += parseInt(cpf.charAt(i)) * (10 - i);
                }

                let resto = (soma * 10) % 11;
                if (resto === 10 || resto === 11) resto = 0;
                if (resto !== parseInt(cpf.charAt(9))) return false;

                soma = 0;
                for (let i = 0; i < 10; i++) {
                    soma += parseInt(cpf.charAt(i)) * (11 - i);
                }

                resto = (soma * 10) % 11;
                if (resto === 10 || resto === 11) resto = 0;
                if (resto !== parseInt(cpf.charAt(10))) return false;

                return true;
            }

            const telefoneInput = document.getElementById('telefone');
            const cpfInput = document.getElementById('cpf');

            // máscaras para os inputs
            IMask(telefoneInput, {
                mask: '(00) 00000-0000'
            });

            const cpfMask = IMask(cpfInput, {
                mask: '000.000.000-00'
            });

            // validação no envio do formulário
            document.getElementById('form_cad').addEventListener('submit', function(e) {
                const cpfLimpo = cpfMask.unmaskedValue;

                if (!validarCPF(cpfLimpo)) {
                    e.preventDefault(); // se o cpf for inválido, impede envio
                    alert('CPF inválido. Por favor, verifique e tente novamente.');
                    cpfInput.focus();
                } else {
                    cpfInput.value = cpfLimpo; // remove a máscara antes de enviar
                }
            });
        });
    </script>
</body>

</html>