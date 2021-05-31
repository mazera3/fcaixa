<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarBiblioteca
{

    private $DadosId;

    public function apagarBiblioteca($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarBiblioteca = new \App\bib\Models\BibApagarBiblioteca();
           $apagarBiblioteca->apagarBiblioteca($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma biblioteca!</div>";
        }
        $UrlDestino = URLADM . 'listar-biblioteca/listar';
        header("Location: $UrlDestino");
    }

}
