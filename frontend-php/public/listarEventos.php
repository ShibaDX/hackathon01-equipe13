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
        <form method="GET" id="formFiltro">
            <select name="curso" id="filtro" class="form-select" style="width: 150px" onchange="document.getElementById('formFiltro').submit()">
                <option value="">Todos</option>
                <option value="Informática" <?= ($_GET['curso'] ?? '') === 'Informática' ? 'selected' : '' ?>>Informática</option>
                <option value="Direito" <?= ($_GET['curso'] ?? '') === 'Direito' ? 'selected' : '' ?>>Direito</option>
                <option value="Pedagogia" <?= ($_GET['curso'] ?? '') === 'Pedagogia' ? 'selected' : '' ?>>Pedagogia</option>
                <option value="Psicologia" <?= ($_GET['curso'] ?? '') === 'Psicologia' ? 'selected' : '' ?>>Psicologia</option>
            </select>
        </form>

        <div class="row mt-5">
            <?php
            $eventosFiltrados = [];

            if (($dados['code'] === 200) && is_array($dados['body'])) {
                // Aplica o filtro, se existir
                $eventosFiltrados = !empty($_GET['curso'])
                    ? array_filter($dados['body'], fn($evento) => $evento['curso'] === $_GET['curso'])
                    : $dados['body'];
            }

            if (!empty($eventosFiltrados)):
                foreach ($eventosFiltrados as $eventoInfo):
                    $dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
                    $horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');
            ?>
                    <div class="col-lg-3 mb-4">
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
                    </div>
                <?php
                endforeach;
            else:
                ?>
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