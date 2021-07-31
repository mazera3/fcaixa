<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaInformatica
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaInformatica
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT inf.*, m.mes, m.id_mes FROM cx_conta_informatica inf
        INNER JOIN cx_mes m ON m.id_mes=inf.mes_id
        WHERE id_inf =:id_inf LIMIT :limit", "id_inf=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
