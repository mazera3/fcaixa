<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarBibliografia
{

    private $DadosId;

    public function apagarBibliografia($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarBibliografia = new \App\bib\Models\BibApagarBibliografia();
           $apagarBibliografia->apagarBibliografia($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma Bibliografia!</div>";
        }
        $UrlDestino = URLADM . 'bibliografias/listar';
        header("Location: $UrlDestino");
    }

}
