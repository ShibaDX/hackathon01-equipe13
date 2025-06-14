<?php
session_start();
require_once '../includes/auth.php';
require_auth();

require_once '../classes/Inscricao.php';
require_once '../classes/Eventos.php';
require_once '../classes/Palestrantes.php';

$inscricaoObj = new Inscricao();
$eventoObj = new Eventos();
$palestrante = new Palestrantes();


// Suponha que exista esse método na API PHP que retorna as inscrições do aluno
$inscricoes = $inscricaoObj->listarInscricoesPorAluno($_SESSION['aluno_id']);
var_dump($inscricoes);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <?php require_once '../includes/bootstrap_css.php' ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>


<body>
    <?php require_once '../includes/header.php' ?>

                        <!-- Modal -->
                        <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLabelLogout" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabelLogout">Confirmar Logout</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja sair da conta?
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <a href="../includes/logout.php"><button class="btn btn-danger">Sair da conta</button></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

<div class="d-flex justify-content-end me-4 mt-3">
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalLogout">
        Sair
    </button>
</div>

    <div class="container ps-5">
        <h2>Meu Perfil</h2>
        <div class="d-flex align-items-center mt-3">
            <!-- Avatar -->
            <div class="perfil-avatar me-4">
                <img src="../img/avatar.png" alt="">
            </div>

            <!-- Informações -->
            <div class="perfil-info">
                <p><strong>Nome:</strong> <?= $_SESSION['aluno_nome'] ?></p>
                <p><strong>E-mail:</strong> <?= $_SESSION['aluno_email'] ?></p>
            </div>

        </div>
    </div>
    <h2 class="ms-5 mb-5 mt-5">Eventos Inscritos</h2>
    <?php
    // Agora percorremos cada inscrição e buscamos os dados do evento
    foreach ($inscricoes['body'] as $inscricao) {
        $eventoId = $inscricao['evento_id'];

        $evento = $eventoObj->buscarEvento($eventoId);

        if ($evento['code'] === 200 && !empty($evento['body'][0])) {
            $e = $evento['body'][0];

    ?>
            <div class="container evento-container mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-start">
                        <div class="evento-imagem me-3">
                            <img src="<?php echo Eventos::IMG_DIR . $e['foto']; ?>" alt="Imagem do evento" width="120" height="80">
                        </div>
                        <div class="evento-info">
                            <strong><?php echo htmlspecialchars($e['titulo']); ?> - <?php echo htmlspecialchars($e['curso']); ?></strong>
                            <p><?php
                                $dadosPalestrante = $palestrante->buscarPalestrante($e['palestrante_id']);
                                $palestranteInfo = $dadosPalestrante['body'];
                                echo $palestranteInfo['nome']; ?></p>
                            <p><?php echo htmlspecialchars($e['lugar']); ?></p>
                            <p><?php echo date('d/m/Y', strtotime($e['data'])); ?> - <?= date('H:i', strtotime($e['hora'])); ?></p>
                        </div>
                    </div>
                    <div>
                        <!-- Botão que abre o modal -->
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $inscricao['id'] ?>">Desinscrever</button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalExcluir<?= $inscricao['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $inscricao['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel<?= $inscricao['id'] ?>">Confirmar desinscrição</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja se desinscrever deste evento?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="../includes/desinscrever.php">
                                            <input type="hidden" name="inscricao_id" value="<?= $inscricao['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Sim, desinscrever</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <?php require_once '../includes/footer.php' ?>
    <script src="https://kit.fontawesome.com/0215a38eba.js" crossorigin="anonymous"></script>
    <?php require_once '../includes/bootstrap_js.php' ?>
</body>

</html>