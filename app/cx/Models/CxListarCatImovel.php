<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Lopation: /");
    exit();
}

/**
 * Description of CxListarCatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarCatImovel {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 30;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarImovel($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'cat-imovel/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_imv) AS num_result FROM cx_imovel imv");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarImovel = new \App\adms\Models\helper\AdmsRead();
        $listarImovel->fullRead("SELECT imv.* FROM cx_imovel imv
        ORDER BY id_imv ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarImovel->getResultado();
        return $this->Resultado;
    }

}
