<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxVerEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerEntrada
{

    private $Resultado;
    private $DadosId;

    public function verEntrada($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verEntrada = new \App\adms\Models\helper\AdmsRead();
        $verEntrada->fullRead("SELECT ent.*, cat.categoria, dc.descricao FROM cx_entrada ent
        INNER JOIN cx_descricao dc ON dc.id_des=ent.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        WHERE id_ent =:id_ent LIMIT :limit", "id_ent=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verEntrada->getResultado();
        return $this->Resultado;
    }
}
