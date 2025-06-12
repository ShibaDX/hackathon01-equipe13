<?php

require_once 'ApiNodeService.php';

class Eventos
{
    const imgDir = 'img/uploads';

    public function listarEventos()
    {
        $api = new ApiNodeService();
        $evento = $api->listarEventos();
        return $evento;
    }

    public function buscarEvento(int $id)
    {
        $api = new ApiNodeService();
        $evento = $api->buscarEvento($id);

        return $evento;
    }

}
