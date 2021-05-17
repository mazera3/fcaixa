<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarUf
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarUf
{

    private $DadosId;

    public function apagarUf($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarUf = new \App\bib\Models\BibApagarUf();
           $apagarUf->apagarUf($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um estado!</div>";
        }
        $UrlDestino = URLADM . 'uf/listar';
        header("Location: $UrlDestino");
    }

}
