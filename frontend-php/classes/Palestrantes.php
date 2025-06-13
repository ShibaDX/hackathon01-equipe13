<?php

require_once 'ApiNodeService.php';

class Palestrantes
{

    public function buscarPalestrante(int $id)
    {
        $api = new ApiNodeService();
        $palestrante = $api->buscarPalestrante($id);

        return $palestrante;
    }
}
