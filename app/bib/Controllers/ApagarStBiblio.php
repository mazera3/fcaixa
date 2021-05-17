<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarStBiblio
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarStBiblio
{

    private $DadosId;

    public function apagarStBiblio($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarStBiblio = new \App\bib\Models\BibApagarStBiblio();
           $apagarStBiblio->apagarStBiblio($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma Situação!</div>";
        }
        $UrlDestino = URLADM . 'situacoes/listar';
        header("Location: $UrlDestino");
    }

}
