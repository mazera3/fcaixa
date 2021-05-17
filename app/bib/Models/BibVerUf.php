<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerUf
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerUf
{
    private $Resultado;
    private $DadosId;
    
    public function verUf($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verUf = new \App\adms\Models\helper\AdmsRead();
        $verUf->fullRead("SELECT uf.*, p.* FROM bib_uf uf
                INNER JOIN bib_pais p ON p.pais_id=uf.id_pais
                WHERE uf.uf_id =:uf_id LIMIT :limit", "uf_id=".$this->DadosId."&limit=1");
        $this->Resultado= $verUf->getResultado();
        return $this->Resultado;
    }
}
