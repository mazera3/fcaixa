<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaConstrucao
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaConstrucao
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT con.*, m.mes, m.id_mes FROM cx_conta_construcao con
        INNER JOIN cx_mes m ON m.id_mes=con.mes_id
        WHERE id_con =:id_con LIMIT :limit", "id_con=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
