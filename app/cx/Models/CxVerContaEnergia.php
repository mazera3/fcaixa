<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaEnergia
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT ene.*, m.mes, m.id_mes FROM cx_conta_energia ene
        INNER JOIN cx_mes m ON m.id_mes=ene.mes_id
        WHERE id_ene =:id_ene LIMIT :limit", "id_ene=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
