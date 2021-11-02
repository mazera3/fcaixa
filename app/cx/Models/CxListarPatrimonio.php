<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Lopation: /");
    exit();
}

/**
 * Description of CxListarPatrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarPatrimonio
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 30;
    private $ResultadoPg;
    private $UserId;

    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    public function listarPatrimonio($PageId = null, $UserId = null)
    {
        $this->PageId = (int) $PageId;
        $this->UserId = (int) $UserId;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'patrimonio/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_pat) AS num_result FROM cx_patrimonio pat");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarPatrimonio = new \App\adms\Models\helper\AdmsRead();
        $listarPatrimonio->fullRead("SELECT pat.*, imv.* FROM cx_patrimonio pat
        INNER JOIN cx_imovel imv ON imv.id_imv=pat.cod_pat
        WHERE usuario_id = :usuario_id
        ORDER BY id_pat ASC LIMIT :limit OFFSET :offset", "usuario_id={$this->UserId}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarPatrimonio->getResultado();
        return $this->Resultado;
    }
}
