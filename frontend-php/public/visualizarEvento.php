<?php
session_start();

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

    if (!isset($_SESSION['aluno_logado']) || !$_SESSION['aluno_logado'] == true) {
        $erro = 'Você precisa entrar em uma conta para se inscrever';
    } else {

        $aluno_id = $_POST['aluno_id'];
        $evento_id = $_POST['evento_id'];

        try {
            $code = $inscricao->inscrever($aluno_id, $evento_id);
            if ($code === 201) {
                $sucesso = "Aluno inscrito com sucesso.";
            } else if ($code === 400) {
                $erro = "Aluno já inscrito nesse evento";
            } else {
                $erro = "Erro ao inscrever aluno. Código: $code";
            }
        } catch (Exception $e) {
            $erro = 'Erro ao inscrever: ' . $e->getMessage();
            echo "<br>Erro";
        }
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

                <!-- Título -->
                <div class="col-12 order-1 mb-3">
                    <h2><?= $eventoInfo['titulo'] ?></h2>
                </div>

                <!-- Imagem -->
                <div class="col-12 col-md-6 order-2 order-md-2">
                    <div style="width: 100%; height: 300px; display: flex; justify-content: center; align-items: center; overflow: hidden; background-color: #f8f9fa;">
                        <img class="imgVisualizar img-fluid" src="<?= Eventos::IMG_DIR . $eventoInfo['foto']; ?>" alt="" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                </div>

                <!-- Informações + botão -->
                <div class="col-12 col-md-6 order-3 order-md-3 pt-4 pt-md-0">
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
                        <input type="hidden" name="aluno_id" value="<?php if (isset($_SESSION['aluno_logado']) && $_SESSION['aluno_logado'] === true) echo $_SESSION['aluno_id'] ?? '' ?>">
                        <input type="hidden" name="evento_id" value="<?= $eventoInfo['id'] ?>">
                        <button type="submit" class="btn btn-primary btn-lg">INSCREVER-SE</button>
                    </form>
                </div>
            </div>
            <div class="descricao col-12 order-4 pt-3">
                <h4>Descrição:</h4>
                <p><?= $eventoInfo['descricao'] ?></p>
            </div>
        </div>
    </main>

    <?php require_once '../includes/footer.php' ?>
    <?php require_once '../includes/bootstrap_js.php' ?>
</body>

</html>