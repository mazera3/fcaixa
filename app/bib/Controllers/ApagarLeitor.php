<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarLeitor
{

    private $DadosId;

    public function apagarLeitor($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarLeitor = new \App\bib\Models\BibApagarLeitor();
           $apagarLeitor->apagarLeitor($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um Leitor!</div>";
        }
        $UrlDestino = URLADM . 'leitores/listar';
        header("Location: $UrlDestino");
    }

}
