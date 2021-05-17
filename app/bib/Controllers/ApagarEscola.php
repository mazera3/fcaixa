<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarEscola
{

    private $DadosId;

    public function apagarEscola($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarEscola = new \App\bib\Models\BibApagarEscola();
           $apagarEscola->apagarEscola($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma escola!</div>";
        }
        $UrlDestino = URLADM . 'escola/listar';
        header("Location: $UrlDestino");
    }

}
