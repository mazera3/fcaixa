<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaMecanica
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaMecanica
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT mec.*, m.mes, m.id_mes FROM cx_conta_mecanica mec
        INNER JOIN cx_mes m ON m.id_mes=mec.mes_id
        WHERE id_mec =:id_mec LIMIT :limit", "id_mec=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
