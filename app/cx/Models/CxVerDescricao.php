<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerDescricao
{

    private $Resultado;
    private $DadosId;

    public function verDescricao($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verDescricao = new \App\adms\Models\helper\AdmsRead();
        $verDescricao->fullRead("SELECT * FROM cx_descricao
                WHERE id_des =:id_des LIMIT :limit", "id_des=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verDescricao->getResultado();
        return $this->Resultado;
    }
}
