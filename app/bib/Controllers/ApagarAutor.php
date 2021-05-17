<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarAutor
{

    private $DadosId;

    public function apagarAutor($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarAutor = new \App\bib\Models\BibApagarAutor();
           $apagarAutor->apagarAutor($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um autor!</div>";
        }
        $UrlDestino = URLADM . 'autores/listar';
        header("Location: $UrlDestino");
    }

}
