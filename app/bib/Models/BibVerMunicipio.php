<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerMunicipio
{
    private $Resultado;
    private $DadosId;
    
    public function verMunicipio($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verMunicipio = new \App\adms\Models\helper\AdmsRead();
        $verMunicipio->fullRead("SELECT mun.*, uf.uf, uf.nome nome_uf FROM bib_municipio mun
                INNER JOIN bib_uf uf ON uf.uf_id=mun.id_uf
                WHERE mun.mun_id =:mun_id LIMIT :limit", "mun_id=".$this->DadosId."&limit=1");
        $this->Resultado= $verMunicipio->getResultado();
        return $this->Resultado;
    }
}
