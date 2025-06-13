<?php
require_once '../classes/Eventos.php';
require_once '../classes/Palestrantes.php';
require_once '../classes/Inscricao.php';

$inscricao = new Inscricao();
$palestrante = new Palestrantes();
$evento = new Eventos();
$dados = $evento->buscarEvento($_GET['id']);
$eventoInfo = $dados['body'][0];

$dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
$horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $evento_id = $_POST['evento_id'];

    try {
        // Chamada para a API Node.js
        $inscricao->inscrever($aluno_id, $evento_id);
        $sucesso = 'Aluno inscrito com sucesso!';
        echo "<br>Sucesso";
    } catch (Exception $e) {
        $erro = 'Erro ao inscrever: ' . $e->getMessage();
        echo "<br>Erro";
    }
}

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
                    <img class="imgVisualizar" src="<?= Eventos::IMG_DIR . $eventoInfo['foto']; ?>" alt="" style="width: 650px;">
                </div>
                <div class="col pt-5">
                    <p>Palestrante:
                        <a href="visualizarPalestrante.php?id=<?= $eventoInfo['palestrante_id'] ?>">
                            <?php
                            $dadosPalestrante = $palestrante->buscarPalestrante($eventoInfo['palestrante_id']);
                            $palestranteInfo = $dadosPalestrante['body'][0];
                            echo $palestranteInfo['nome'];
                            ?>
                        </a>
                    </p>
                    <p>Local: <?= $eventoInfo['lugar'] ?></p>
                    <p>Data: <?= $dataFormatada ?> - Hora: <?= $horaFormatada ?></p>
                    <form method="post">
                        <input type="hidden" name="aluno_id" value="2">
                        <input type="hidden" name="evento_id" value="<?= $eventoInfo['id'] ?>">
                        <button type="submit" class="btn btn-primary btn-lg ">INSCREVER-SE</button>
                    </form>
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