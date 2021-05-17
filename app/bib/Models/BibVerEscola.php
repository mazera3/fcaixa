<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerEscola
{
    private $Resultado;
    private $DadosId;
    
    public function verEscola($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verEscola = new \App\adms\Models\helper\AdmsRead();
        $verEscola->fullRead("SELECT es.* FROM bib_escola es
                WHERE id_escola =:id_escola LIMIT :limit", "id_escola=".$this->DadosId."&limit=1");
        $this->Resultado= $verEscola->getResultado();
        return $this->Resultado;
    }
}
