<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaMercado
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaMercado
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT mer.*, m.mes, m.id_mes FROM cx_conta_mercado mer
        INNER JOIN cx_mes m ON m.id_mes=mer.mes_id
        WHERE id_mer =:id_mer LIMIT :limit", "id_mer=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
