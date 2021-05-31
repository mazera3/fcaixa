<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarInstituicao
{

    private $DadosId;

    public function apagarInstituicao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarInstituicao = new \App\bib\Models\BibApagarInstituicao();
           $apagarInstituicao->apagarInstituicao($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma instituicao!</div>";
        }
        $UrlDestino = URLADM . 'instituicao/listar';
        header("Location: $UrlDestino");
    }

}
