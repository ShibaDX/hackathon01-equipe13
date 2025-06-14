<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="../img/logo.png" alt="Logo" width="75" height="75" class="d-inline-block ">
            <a class="navbar-brand ps-3" href="#">Alfa Eventos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listarEventos.php">Eventos</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center me-3 ">
                    <?php if (isset($_SESSION['aluno_logado']) && $_SESSION['aluno_logado'] === true): ?>
                        <img src="../img/avatar.png" class="img-profile">
                        <a href="perfilAluno.php" class="nome-header" style="text-decoration: none; color: inherit;"><?= $_SESSION['aluno_nome'] ?></a>


                    <?php else: ?>
                        <a href="login.php"><button class="btn btn-primary">ENTRAR</button></a>
                    <?php endif ?>
                </div>
            </div>
    </nav>
</header>