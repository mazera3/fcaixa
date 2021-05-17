<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarCopia {

    private $Dados;
    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarCopia($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop_id) AS num_result FROM bib_copia");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarCopia = new \App\adms\Models\helper\AdmsRead();
        $listarCopia->fullRead("SELECT cop.*, bib.*, stc.nome nome_stc, cr.cor cor_cr, aut.autor, ed.editora, bib.opac_flag
                FROM bib_copia cop 
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarCopia->getResultado();
        return $this->Resultado;
    }

    public function contarBiblio() {
        $contarBiblio = new \App\adms\Models\helper\AdmsRead();
        $contarBiblio->fullRead("SELECT bib.bib_id,
      COUNT(cp.cop_bib_id) AS cont, bib.*
      FROM  bib_copia cp
      INNER JOIN bib_biblio bib ON bib.bib_id = cp.cop_bib_id
      GROUP BY bib.bib_id
      ORDER BY bib.bib_id ASC");
        $this->Resultado = $contarBiblio->getResultado();
        return $this->Resultado;
    }

    public function qtBiblio() {
        $qtBiblio = new \App\adms\Models\helper\AdmsRead();
        $qtBiblio->fullRead("SELECT COUNT(bib_id) AS num_result FROM bib_biblio");
        $this->Resultado = $qtBiblio->getResultado();
        return $this->Resultado;
    }

}
