<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerEditora
{
    private $Resultado;
    private $DadosId;
    
    public function verEditora($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verEditora = new \App\adms\Models\helper\AdmsRead();
        $verEditora->fullRead("SELECT ed.* , uf.uf, uf.nome nome_uf, p.nome_pais, p.sigla FROM bib_editora ed
                INNER JOIN bib_uf uf ON uf.uf_id=ed.id_uf
                INNER JOIN bib_pais p ON p.pais_id=ed.id_pais
                WHERE ed.ed_id =:ed_id LIMIT :limit", "ed_id=".$this->DadosId."&limit=1");
        $this->Resultado= $verEditora->getResultado();
        return $this->Resultado;
    }
}
