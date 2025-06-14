<?php
session_start();
require_once '../includes/auth.php';
require_auth();
require_once '../classes/Eventos.php';
require_once '../classes/Palestrantes.php';

$palestrante = new Palestrantes();
$evento = new Eventos();
$dados = $evento->listarEventos();

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

    <div class="container mt-4">
        <h1><i class="fa-regular fa-calendar-days"></i> Eventos</h1>
        <h3 class="mt-3">Filtro</h3>
        <select name="filtro" id="filtro" class="form-select" style="width: 150px">
            <option value="Informática">Informática</option>
            <option value="Direito">Direito</option>
            <option value="Pedagogia">Pedagogia</option>
            <option value="Psicologia">Psicologia</option>
        </select>

        <div class="row mt-5 ">
            <?php if (($dados['code'] === 200) && (is_array($dados['body'])) && (!is_null($dados['body']))): ?>
                <?php foreach ($dados['body'] as $eventoInfo): ?>
                    <?php
                    $dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
                    $horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');
                    ?>
                    <div class="col-lg-3 mb-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $eventoInfo['titulo'] ?></h5>
                                <p><?= $eventoInfo['curso'] ?></p>
                                <p><i class="fa-solid fa-location-dot"></i> <strong><?= $eventoInfo['lugar'] ?></strong></p>
                                <img src="<?= Eventos::IMG_DIR . $eventoInfo['foto']; ?>" class="card-img" alt="Banner do Evento">
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p>Palestrante:
                                        <?php
                                        $dadosPalestrante = $palestrante->buscarPalestrante($eventoInfo['palestrante_id']);
                                        $palestranteInfo = $dadosPalestrante['body'];
                                        echo $palestranteInfo['nome'];
                                        ?>
                                    </p>
                                    <p>Data: <?= $dataFormatada ?> - Hora: <?= $horaFormatada ?> </p>
                                    <a href="visualizarEvento.php?id=<?= $eventoInfo['id'] ?>"><button class="btn btn-primary">Saiba mais</button></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="alert alert-warning">Nenhum evento encontrado.</p>
                </div>
            <?php endif; ?>
        </div>


    </div>

    <?php require_once '../includes/footer.php' ?>
    <script src="https://kit.fontawesome.com/0215a38eba.js" crossorigin="anonymous"></script>
    <?php require_once '../includes/bootstrap_js.php' ?>
</body>

</html>