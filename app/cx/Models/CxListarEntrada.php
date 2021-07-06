<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarEntrada {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarEntrada($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'entrada/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_ent) AS num_result FROM cx_entrada ent
        INNER JOIN cx_descricao dc ON dc.id_des=ent.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarEntrada = new \App\adms\Models\helper\AdmsRead();
        $listarEntrada->fullRead("SELECT ent.*, cat.categoria, dc.descricao FROM cx_entrada ent
        INNER JOIN cx_descricao dc ON dc.id_des=ent.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ORDER BY id_ent ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarEntrada->getResultado();
        return $this->Resultado;
    }
}
