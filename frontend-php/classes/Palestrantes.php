<?php

require_once 'ApiNodeService.php';

class Palestrantes
{
    const IMG_DIR = '../img/uploads/';

    public function buscarPalestrante(int $id)
    {
        $api = new ApiNodeService();
        $palestrante = $api->buscarPalestrante($id);

        return $palestrante;
    }
}
