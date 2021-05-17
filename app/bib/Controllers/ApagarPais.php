<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarPais
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarPais
{

    private $DadosId;

    public function apagarPais($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarPais = new \App\bib\Models\BibApagarPais();
           $apagarPais->apagarPais($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um País!</div>";
        }
        $UrlDestino = URLADM . 'pais/listar';
        header("Location: $UrlDestino");
    }

}
