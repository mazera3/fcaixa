<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerSaida
{

    private $Resultado;
    private $DadosId;

    public function verSaida($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verSaida = new \App\adms\Models\helper\AdmsRead();
        $verSaida->fullRead("SELECT sai.*, cat.categoria, dc.descricao, m.* FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        INNER JOIN cx_mes m ON m.id_mes=sai.mes_id
        WHERE id_sai =:id_sai LIMIT :limit", "id_sai=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verSaida->getResultado();
        return $this->Resultado;
    }
}
