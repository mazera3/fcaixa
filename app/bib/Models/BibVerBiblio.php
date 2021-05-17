<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerBiblio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerBiblio {

    private $Resultado;
    private $DadosId;

    public function verBiblio($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verBiblio = new \App\adms\Models\helper\AdmsRead();
        $verBiblio->fullRead("SELECT bib.*, 
            sit.nome nome_sit, cr.cor cor_cr,
            mat.descricao material, col.descricao colecao, ed.editora, aut.autor
                FROM bib_biblio bib
                
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_colecao col ON col.col_id=bib.colecao_id
                INNER JOIN bib_tipo_material mat ON mat.cod_id=bib.tipo_material_id
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                WHERE bib.bib_id =:bib_id LIMIT :limit", "bib_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verBiblio->getResultado();
        return $this->Resultado;
    } // INNER JOIN bib_copia cp ON cp.cop_bib_id=bib.bib_id

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

    public function verCopia($DadosId) {
        $this->DadosId = (int) $DadosId;

        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT cp.*, bib.*, stc.nome nome_stc, cr.cor cor_cr, aut.autor, ed.editora, bib.opac_flag
                FROM bib_copia cp 
                INNER JOIN bib_sits_copia stc ON stc.id=cp.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                ORDER BY cop_id ASC");
        $this->Resultado = $verCopia->getResultado();
        return $this->Resultado;
    }

}
