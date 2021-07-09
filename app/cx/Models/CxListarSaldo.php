<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarSaldo
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarSaldo {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarSaldo($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'saldo/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_sal) AS num_result FROM cx_saldo sal
        INNER JOIN cx_mes m ON m.id_mes=sal.mes_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarSaldo = new \App\adms\Models\helper\AdmsRead();
        $listarSaldo->fullRead("SELECT sal.*, m.mes, m.extenso FROM cx_saldo sal
        INNER JOIN cx_mes m ON m.id_mes=sal.mes_id
        ORDER BY id_sal ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarSaldo->getResultado();
        return $this->Resultado;
    }
}
