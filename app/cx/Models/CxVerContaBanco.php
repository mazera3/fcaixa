<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaBanco
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaBanco
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT ban.*, m.mes, m.id_mes FROM cx_conta_banco ban
        INNER JOIN cx_mes m ON m.id_mes=ban.mes_id
        WHERE id_ban =:id_ban LIMIT :limit", "id_ban=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
