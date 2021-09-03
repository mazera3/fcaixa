<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaSocial
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaSocial
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT soc.*, m.mes, m.id_mes FROM cx_conta_social soc
        INNER JOIN cx_mes m ON m.id_mes=soc.mes_id
        WHERE id_soc =:id_soc LIMIT :limit", "id_soc=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
