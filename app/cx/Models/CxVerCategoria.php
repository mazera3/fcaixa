<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerCategoria
{

    private $Resultado;
    private $DadosId;

    public function verCategoria($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verCategoria = new \App\adms\Models\helper\AdmsRead();
        $verCategoria->fullRead("SELECT * FROM cx_categoria
                WHERE id_cat =:id_cat LIMIT :limit", "id_cat=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verCategoria->getResultado();
        return $this->Resultado;
    }
}
