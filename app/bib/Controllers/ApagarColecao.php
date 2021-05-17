<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarColecao
{

    private $DadosId;

    public function apagarColecao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarColecao = new \App\bib\Models\BibApagarColecao();
           $apagarColecao->apagarColecao($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de colecao!</div>";
        }
        $UrlDestino = URLADM . 'colecao/listar';
        header("Location: $UrlDestino");
    }

}
