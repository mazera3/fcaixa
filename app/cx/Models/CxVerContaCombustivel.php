<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaCombustivel
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaCombustivel
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT comb.*, m.mes, m.id_mes FROM cx_conta_combustivel comb
        INNER JOIN cx_mes m ON m.id_mes=comb.mes_id
        WHERE id_comb =:id_comb LIMIT :limit", "id_comb=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
