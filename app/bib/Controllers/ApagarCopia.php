<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarCopia
{

    private $DadosId;

    public function apagarCopia($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarCopia = new \App\bib\Models\BibApagarCopia();
           $apagarCopia->apagarCopia($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma Cópia!</div>";
        }
        $UrlDestino = URLADM . 'copias/listar';
        header("Location: $UrlDestino");
    }

}
