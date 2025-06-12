<?php

require_once 'ApiNodeService.php';

class Eventos
{
    public function listarEventos()
    {
        $api = new ApiNodeService();
        $evento = $api->listarEventos();

    }

    public function buscarEvento(int $id)
    {
        $api = new ApiNodeService();
        $evento = $api->buscarEvento($id);
    }

}
