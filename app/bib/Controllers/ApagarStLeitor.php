<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarStLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarStLeitor
{

    private $DadosId;

    public function apagarStLeitor($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarStLeitor = new \App\bib\Models\BibApagarStLeitor();
           $apagarStLeitor->apagarStLeitor($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma Situação!</div>";
        }
        $UrlDestino = URLADM . 'situacoes/listar';
        header("Location: $UrlDestino");
    }

}
