<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerContaFone
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerContaFone
{

    private $Resultado;
    private $DadosId;

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT fon.*, m.mes, m.id_mes FROM cx_conta_fone fon
        INNER JOIN cx_mes m ON m.id_mes=fon.mes_id
        WHERE id_fon =:id_fon LIMIT :limit", "id_fon=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }
}
