<?php
session_start();

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
    <div class="banner">
        <h1>Bem-vindo à Alfa Eventos</h1>
        <h4 class="pt-5">"Eventos que inspiram, conectam e transformam o ambiente acadêmico em algo ainda maior."</h4>
    </div>

    <?php
    $eventosFiltrados = [];

    if (($dados['code'] === 200) && is_array($dados['body'])) {
        $eventosFiltrados = array_filter($dados['body'], function ($evento) {
            // verifica se o evento possui 20 ou mais participantes
            return $evento['cont_participantes'] >= 20;
        });
    }

    if (!empty($eventosFiltrados)): ?>

        <div class="text-bg mt-5 mb-3">
            <h3 class="d-flex">Populares</h3>
        </div>

        <div class="container">


            <div class="eventos-linha">
                <?php foreach ($eventosFiltrados as $eventoInfo):
                    $dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
                    $horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');
                ?>

                    <div class="card border-primary" style="width: 18rem;">
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
            <?php
                endforeach;
            endif; ?>
            </div>

        </div>

        <div class="text-bg  mt-5 mb-3">
            <h3 class="d-flex ">Em breve</h3>
        </div>
        <div class="container">
            <div class="eventos-linha">
                <?php if (($dados['code'] === 200) && (is_array($dados['body'])) && (!is_null($dados['body']))): ?>
                    <?php foreach ($dados['body'] as $eventoInfo):
                        $dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
                        $horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');
                    ?>
                        <div class="card border-primary" style="width: 18rem;">
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