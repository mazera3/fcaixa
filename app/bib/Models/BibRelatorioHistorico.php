<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibRelatorioHistorico
 *
 * @copyright (c) year, Édio Mazera
 */
class BibRelatorioHistorico {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarHistorico($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'relatorio-historico/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_hist) AS num_result FROM bib_historico");
        $this->ResultadoPg = $paginacao->getResultado();

        $contarAtrasos = new \App\adms\Models\helper\AdmsRead();
        $contarAtrasos->fullRead("SELECT his.created criado, his.*, cp.*, bib.*, lt.*, au.*, ed.* FROM bib_historico his 
                INNER JOIN bib_copia cp ON cp.cop_id=his.cp_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_autores au ON au.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_leitor lt ON lt.leitor_id=his.id_lt
                ORDER BY id_hist ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $contarAtrasos->getResultado();
        return $this->Resultado;
    }

}
