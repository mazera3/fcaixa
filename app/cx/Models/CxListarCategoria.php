<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarCategoria {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 30;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarCategoria($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'categoria/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_cat) AS num_result FROM cx_categoria cat");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarCategoria = new \App\adms\Models\helper\AdmsRead();
        $listarCategoria->fullRead("SELECT cat.* FROM cx_categoria cat
        ORDER BY id_cat ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarCategoria->getResultado();
        return $this->Resultado;
    }
}
