<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaAgropecuaria
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaAgropecuaria
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT agr.*, m.mes, m.id_mes FROM cx_conta_agropecuaria agr
        INNER JOIN cx_mes m ON m.id_mes=agr.mes_id
        WHERE id_agr =:id_agr LIMIT :limit", "id_agr=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
