<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarSaida {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarSaida($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'saida/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_sai) AS num_result FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarSaida = new \App\adms\Models\helper\AdmsRead();
        $listarSaida->fullRead("SELECT sai.*, cat.categoria, dc.descricao FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ORDER BY id_sai ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarSaida->getResultado();
        return $this->Resultado;
    }
}
