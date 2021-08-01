<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaLoja
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaLoja
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT loj.*, m.mes, m.id_mes FROM cx_conta_loja loj
        INNER JOIN cx_mes m ON m.id_mes=loj.mes_id
        WHERE id_loj =:id_loj LIMIT :limit", "id_loj=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
