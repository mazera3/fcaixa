<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerBairro
{
    private $Resultado;
    private $DadosId;
    
    public function verBairro($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verBairro = new \App\adms\Models\helper\AdmsRead();
        $verBairro->fullRead("SELECT br.*, mun.municipio FROM bib_bairro br
                INNER JOIN bib_municipio mun ON mun.mun_id=br.id_mun
                WHERE br.br_id =:br_id LIMIT :limit", "br_id=".$this->DadosId."&limit=1");
        $this->Resultado= $verBairro->getResultado();
        return $this->Resultado;
    }
}
