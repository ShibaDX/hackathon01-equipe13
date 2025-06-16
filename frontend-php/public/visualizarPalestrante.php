<?php
session_start();

if (isset($_SESSION['aluno_logado']) && $_SESSION['aluno_logado'] === true) {
    echo "Sessão ativa. ID do aluno: " . $_SESSION['aluno_id'];
} else {
    echo "Usuário não está logado.";
}
require_once '../classes/Palestrantes.php';

$palestrante = new Palestrantes();
$dados = $palestrante->buscarPalestrante($_GET['id']);
$palestranteInfo = $dados['body'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfa Eventos</title>
    <?php require_once '../includes/bootstrap_css.php' ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>

<body>
    <?php require_once '../includes/header.php' ?>

    <main>
        <div class="container-fluid pt-4">
            <div class="row">
                
                <!-- Título -->
                <div class="col-12 order-1">
                    <h2><?= $palestranteInfo['nome'] ?></h2>
                </div>

                <!-- Imagem -->
                <div class="col-12 col-md-6 order-2 order-md-2">
                    <div style="width: 100%; height: 400px; display: flex; justify-content: center; align-items: center; overflow: hidden; background-color: #f8f9fa;">
                        <img class="imgVisualizar img-fluid" src="<?= Palestrantes::IMG_DIR . $palestranteInfo['foto']; ?>" alt="" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                </div>

                <!-- Especialidade + Descrição -->
                <div class="col-12 col-md-6 order-3 order-md-3 pt-4 pt-md-0">
                    <p><strong>Especialidade:</strong> <?= $palestranteInfo['tema'] ?></p>
                    <p><strong>Descrição:</strong> <?= $palestranteInfo['descricao'] ?></p>
                </div>
            </div>
        </div>
    </main>

    <?php require_once '../includes/footer.php' ?>
    <?php require_once '../includes/bootstrap_js.php' ?>
</body>

</html>