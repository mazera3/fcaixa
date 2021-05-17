<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerMaterial
{
    private $Resultado;
    private $DadosId;
    
    public function verMaterial($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verMaterial = new \App\adms\Models\helper\AdmsRead();
        $verMaterial->fullRead("SELECT mat.* FROM bib_tipo_material mat
                WHERE mat.cod_id =:cod_id LIMIT :limit", "cod_id=".$this->DadosId."&limit=1");
        $this->Resultado= $verMaterial->getResultado();
        return $this->Resultado;
    }
}
