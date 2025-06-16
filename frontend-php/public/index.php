<?php
session_start();

if (isset($_SESSION['aluno_logado']) && $_SESSION['aluno_logado'] === true) {
    echo "Sessão ativa. ID do aluno: " . $_SESSION['aluno_id'];
} else {
    echo "Usuário não está logado.";
}

require_once '../classes/Eventos.php';
require_once '../classes/Palestrantes.php';

$palestrante = new Palestrantes();
$evento = new Eventos();
$dados = $evento->listarEventos();
// RETIRAR A SEÇÃO "POPULARES" SE NÃO DER TEMPO DE FAZER
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
    <div class="banner"></div>

    <div class="container mt-5">
        <h3 class="pb-3">Populares</h3>

        <div class="eventos-linha">

            <div class="card d-inline-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nome do Evento</h5>
                    <p><i class="fa-solid fa-location-dot"></i> <strong>UniALFA - Sala 05</strong></p>
                    <img src="https://placehold.co/250x150" class="card-img" alt="Banner do Evento">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p>Palestrante: </p>
                        <p>Data: 13/05/2025 - Hora: 09:00 </p>
                        <button class="btn btn-primary">Saiba mais</button>
                    </li>
                </ul>
            </div>

            <div class="card d-inline-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nome do Evento</h5>
                    <p><i class="fa-solid fa-location-dot"></i> <strong>UniALFA - Sala 05</strong></p>
                    <img src="https://placehold.co/250x150" class="card-img" alt="Banner do Evento">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p>Palestrante: </p>
                        <p>Data: 13/05/2025 - Hora: 09:00 </p>
                        <button class="btn btn-primary">Saiba mais</button>
                    </li>
                </ul>
            </div>

            <div class="card d-inline-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nome do Evento</h5>
                    <p><i class="fa-solid fa-location-dot"></i> <strong>UniALFA - Sala 05</strong></p>
                    <img src="https://placehold.co/250x150" class="card-img" alt="Banner do Evento">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p>Palestrante: </p>
                        <p>Data: 13/05/2025 - Hora: 09:00 </p>
                        <button class="btn btn-primary">Saiba mais</button>
                    </li>
                </ul>
            </div>

            <div class="card d-inline-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nome do Evento</h5>
                    <p><i class="fa-solid fa-location-dot"></i> <strong>UniALFA - Sala 05</strong></p>
                    <img src="https://placehold.co/250x150" class="card-img" alt="Banner do Evento">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p>Palestrante: </p>
                        <p>Data: 13/05/2025 - Hora: 09:00 </p>
                        <button class="btn btn-primary">Saiba mais</button>
                    </li>
                </ul>
            </div>

            <div class="card d-inline-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nome do Evento</h5>
                    <p><i class="fa-solid fa-location-dot"></i> <strong>UniALFA - Sala 05</strong></p>
                    <img src="https://placehold.co/250x150" class="card-img" alt="Banner do Evento">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p>Palestrante: </p>
                        <p>Data: 13/05/2025 - Hora: 09:00 </p>
                        <button class="btn btn-primary">Saiba mais</button>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="container mt-5">
        <h3 class="pb-3">Em Breve</h3>

        <div class="eventos-linha">
            <?php if (($dados['code'] === 200) && (is_array($dados['body'])) && (!is_null($dados['body']))): ?>
                <?php foreach ($dados['body'] as $eventoInfo):
                    $dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
                    $horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');
                ?>
                    <div class="card d-inline-block" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $eventoInfo['titulo'] ?></h5>
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