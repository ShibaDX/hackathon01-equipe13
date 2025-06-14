<?php
session_start();
require_once '../includes/auth.php';
require_auth();

require_once '../classes/Eventos.php';
require_once '../classes/Palestrantes.php';
require_once '../classes/Inscricao.php';

$inscricao = new Inscricao();
$palestrante = new Palestrantes();
$evento = new Eventos();
$dados = $evento->buscarEvento($_GET['id']);
$eventoInfo = $dados['body'][0];
$sucesso = '';
$erro = '';

$dataFormatada = date('d/m/Y', strtotime($eventoInfo['data']));
$horaFormatada = DateTime::createFromFormat('H:i:s', $eventoInfo['hora'])->format('H\hi');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $evento_id = $_POST['evento_id'];

    try {
        $code = $inscricao->inscrever($aluno_id, $evento_id);
        if ($code === 201) {
            $sucesso = "Aluno inscrito com sucesso.";
        } else if ($code === 400) {
            $erro = "Aluno já inscrito nesse evento";
        } else {
            $erro = "Erro ao inscrever aluno. Código: $code" ;
        }
    } catch (Exception $e) {
        $erro = 'Erro ao inscrever: ' . $e->getMessage();
        echo "<br>Erro";
    }
}

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
            <?php if ($sucesso): ?>
                <div class="alert alert-success"><i class="fa-solid fa-check"></i> <?= $sucesso ?></div>
            <?php elseif ($erro): ?>
                <div class="alert alert-danger"><i class="fa-solid fa-xmark"></i> <?= $erro ?></div>
            <?php endif; ?>
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
                            $palestranteInfo = $dadosPalestrante['body'];
                            echo $palestranteInfo['nome'];
                            ?>
                        </a>
                    </p>
                    <p>Local: <?= $eventoInfo['lugar'] ?></p>
                    <p>Data: <?= $dataFormatada ?> - Hora: <?= $horaFormatada ?></p>
                    <form method="post">
                        <input type="hidden" name="aluno_id" value="<?php  if(isset($_SESSION['aluno_logado']) && $_SESSION['aluno_logado'] === true) echo $_SESSION['aluno_id'] ?? '' ?>">
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