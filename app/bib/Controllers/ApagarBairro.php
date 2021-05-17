<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarBairro
{

    private $DadosId;

    public function apagarBairro($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarBairro = new \App\bib\Models\BibApagarBairro();
           $apagarBairro->apagarBairro($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um bairro!</div>";
        }
        $UrlDestino = URLADM . 'bairros/listar';
        header("Location: $UrlDestino");
    }

}
