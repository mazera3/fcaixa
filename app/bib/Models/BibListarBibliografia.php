<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarBibliografia {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarBibliografia($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'bibliografias/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(bib_id) AS num_result FROM bib_biblio");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBibliografia = new \App\adms\Models\helper\AdmsRead();
        $listarBibliografia->fullRead("SELECT bib.*, sit.nome nome_sit, cr.cor cor_cr, ed.editora, uf.uf, aut.autor
                FROM bib_biblio bib
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_uf uf ON uf.uf_id=ed.id_uf
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBibliografia->getResultado();
        return $this->Resultado;
    } //INNER JOIN bib_copia cp ON cp.cop_bib_id=bib.bib_id

    public function contarCopia() {
        $contarCopia = new \App\adms\Models\helper\AdmsRead();
        $contarCopia->fullRead("SELECT bib.bib_id,
      COUNT(cp.cop_bib_id) AS cont, bib.*
      FROM  bib_copia cp
      INNER JOIN bib_biblio bib ON bib.bib_id = cp.cop_bib_id
      GROUP BY bib.bib_id
      ORDER BY bib.bib_id ASC");
        $this->Resultado = $contarCopia->getResultado();
        return $this->Resultado;
    }

    public function qtBiblio() {
        $qtBiblio = new \App\adms\Models\helper\AdmsRead();
        $qtBiblio->fullRead("SELECT COUNT(bib_id) AS num_result FROM bib_biblio");
        $this->Resultado = $qtBiblio->getResultado();
        return $this->Resultado;
    }

}
