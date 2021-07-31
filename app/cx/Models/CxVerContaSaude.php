<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaSaude
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaSaude
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT sau.*, m.mes, m.id_mes FROM cx_conta_saude sau
        INNER JOIN cx_mes m ON m.id_mes=sau.mes_id
        WHERE id_sau =:id_sau LIMIT :limit", "id_sau=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
