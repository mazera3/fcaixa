<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarEditora
{

    private $DadosId;

    public function apagarEditora($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarEditora = new \App\bib\Models\BibApagarEditora();
           $apagarEditora->apagarEditora($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma editora!</div>";
        }
        $UrlDestino = URLADM . 'editoras/listar';
        header("Location: $UrlDestino");
    }

}
