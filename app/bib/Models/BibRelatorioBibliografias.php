<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibRelatorioBibliografias
 *
 * @copyright (c) year, Édio Mazera
 */
class BibRelatorioBibliografias {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarBibliografia($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'relatorio-bibliografias/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(bib_id) AS num_result FROM bib_biblio");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBibliografia = new \App\adms\Models\helper\AdmsRead();
        $listarBibliografia->fullRead("SELECT bib.*, ed.editora, uf.uf, aut.autor
                FROM bib_biblio bib
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_uf uf ON uf.uf_id=ed.id_uf
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBibliografia->getResultado();
        return $this->Resultado;
    }

    public function qtBiblio() {
        $qtBiblio = new \App\adms\Models\helper\AdmsRead();
        $qtBiblio->fullRead("SELECT COUNT(bib_id) AS num_result FROM bib_biblio");
        $this->Resultado = $qtBiblio->getResultado();
        return $this->Resultado;
    }

}
