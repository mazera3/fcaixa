<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerCopia {

    private $Resultado;
    private $DadosId;

    public function verCopia($DadosId) {
        $this->DadosId = (int) $DadosId;

        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT cp.*, bib.*, stc.nome nome_stc, cr.cor cor_cr, 
            sit.nome nome_sit,aut.autor, ed.editora, es.uf,bib.opac_flag
                FROM bib_copia cp 
                INNER JOIN bib_sits_copia stc ON stc.id=cp.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_uf es ON es.uf_id=ed.id_uf
                WHERE cp.cop_id =:cop_id LIMIT :limit", "cop_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verCopia->getResultado();
        return $this->Resultado;
    }

}
