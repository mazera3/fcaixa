<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarDescricao {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 30;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarDescricao($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'descricao/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_des) AS num_result FROM cx_descricao dc
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarDescricao = new \App\adms\Models\helper\AdmsRead();
        $listarDescricao->fullRead("SELECT dc.*, cat.categoria FROM cx_descricao dc
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ORDER BY id_des ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarDescricao->getResultado();
        return $this->Resultado;
    }
}
