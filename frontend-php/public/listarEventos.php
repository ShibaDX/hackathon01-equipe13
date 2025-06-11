<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfa Eventos</title>
    <?php require_once '../includes/bootstrap_css.php' ?>
    <link rel="stylesheet" href="css/style.css">
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

        <div class="row mt-5">

            <div class="col">
                <div class="card" style="width: 18rem;">
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
            <div class="col">
                <div class="card" style="width: 18rem;">
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
            <div class="col">
                <div class="card" style="width: 18rem;">
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


    </div>

    <?php require_once '../includes/footer.php' ?>
    <script src="https://kit.fontawesome.com/0215a38eba.js" crossorigin="anonymous"></script>
    <?php require_once '../includes/bootstrap_js.php' ?>
</body>

</html>