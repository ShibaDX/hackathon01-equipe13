<?php
session_start();
require_once '../includes/auth.php';
require_auth();
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
                <div class="col-6">
                    <h2><?= $palestranteInfo['nome'] ?></h2>
                    <img class="imgVisualizar" src="<?= Palestrantes::IMG_DIR . $palestranteInfo['foto']; ?>" alt="" style="width: 650px;">
                </div>
                <div class="col pt-5">
                    <p>Especialidade: <?= $palestranteInfo['tema']?></p>
                    <p>Descrição: <?= $palestranteInfo['descricao'] ?></p>
                </div>
            </div>
        </div>
    </main>

    <?php require_once '../includes/footer.php' ?>
    <?php require_once '../includes/bootstrap_js.php' ?>
</body>

</html>