<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerLeitor
{
    private $Resultado;
    private $DadosId;
    
    public function verLeitor($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT lt.*, cid.municipio, br.bairro, 
                clas.classificacao, stl.nome nome_stl, cr.cor cor_cr
                FROM bib_leitor lt
                INNER JOIN bib_municipio cid ON cid.mun_id=lt.id_mun
                INNER JOIN bib_bairro br ON br.br_id=lt.bairro_id
                INNER JOIN bib_classificacao clas ON clas.clas_id=lt.classificacao_id
                INNER JOIN bib_sits_leitores stl ON stl.id=lt.sits_leitor_id
                INNER JOIN adms_cors cr ON cr.id=stl.adms_cor_id
                WHERE lt.leitor_id =:leitor_id LIMIT :limit", "leitor_id=".$this->DadosId."&limit=1");
        $this->Resultado= $verLeitor->getResultado();
        return $this->Resultado;
    }
}
