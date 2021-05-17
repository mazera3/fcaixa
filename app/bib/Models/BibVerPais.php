<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerPais
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerPais
{
    private $Resultado;
    private $DadosId;
    
    public function verPais($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPais = new \App\adms\Models\helper\AdmsRead();
        $verPais->fullRead("SELECT p.* FROM bib_pais p
                WHERE p.pais_id =:pais_id LIMIT :limit", "pais_id=".$this->DadosId."&limit=1");
        $this->Resultado= $verPais->getResultado();
        return $this->Resultado;
    }
}
