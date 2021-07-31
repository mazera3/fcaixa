<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaEducacao
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaEducacao
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT edu.*, m.mes, m.id_mes FROM cx_conta_educacao edu
        INNER JOIN cx_mes m ON m.id_mes=edu.mes_id
        WHERE id_edu =:id_edu LIMIT :limit", "id_edu=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
