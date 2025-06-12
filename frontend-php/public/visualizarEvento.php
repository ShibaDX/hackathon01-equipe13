<?php
require_once '../classes/Eventos.php';

$evento = new Eventos();
$dados = $evento->buscarEvento($_GET['id']);
$eventoInfo = $dados['body'][0];

$dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
$horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');

// Falta: Banner e palestrante
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
                    <h2><?= $eventoInfo['titulo'] ?></h2>
                    <img class="imgVisualizar" src="<?php echo Eventos::IMG_DIR . $eventoInfo['foto']; ?>" alt="" style="width: 650px;">
                </div>
                <div class="col pt-5">
                    <p>Palestrante: ROBERTO CARLOS</p>
                    <p>Local: <?= $eventoInfo['lugar'] ?></p>
                    <p>Data: <?= $dataFormatada ?> - Hora: <?= $horaFormatada ?></p>
                    <button type="button" class="btn btn-primary btn-lg ">INSCREVER-SE</button>
                </div>
            </div>
            <div class="descricao">
                <h4>Descrição:</h4>
                <p><?= $eventoInfo['descricao'] ?></p>
            </div>
        </div>
    </main>

    <?php require_once '../includes/footer.php' ?>
    <?php require_once '../includes/bootstrap_js.php' ?>
</body>

</html>