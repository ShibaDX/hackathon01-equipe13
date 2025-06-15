<?php


$titulo = $_POST['titulo_evento'];
$data = $_POST['data_evento'];
$nome = $_POST['nome_aluno'];
$nome_palestrante = $_POST['nome_palestrante'];

require '../includes/dompdf/autoload.inc.php';


use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../includes/dompdf/vendor/autoload.php';

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);


$html = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-image: url('http://localhost/hackathon/hackathon01-equipe13/frontend-php/img/certificado-bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .certificado {
            padding: 40px;
            border-radius: 20px;
        }
        h1 {
            font-size: 36px;
            margin: 45px 0;
        }
        p {
            font-size: 26px;
        }
    </style>
</head>
<body>

    <div class='certificado'>
    <h1>Certificado</h1>
    <p>Certificamos que <strong>$nome</strong> participou do evento <strong>$titulo</strong> ministrado por <strong>$nome_palestrante</strong>, realizado em $data.</p>

        </div>
</body>
</html>
";


$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("certificado.pdf", ["Attachment" => false]);
