<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxContas
 *
 * @copyright (c) year, Édio Mazera
 */
class CxContas
{

    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function listarConta() {

        $listarConta = new \App\adms\Models\helper\AdmsRead();
        $listarConta->fullRead("SELECT con.* FROM cx_contas con
        ORDER BY id_con ASC");
        $this->Resultado = $listarConta->getResultado();
        return $this->Resultado;
    }
}
