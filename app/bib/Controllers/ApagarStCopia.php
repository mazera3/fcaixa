<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarStCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarStCopia
{

    private $DadosId;

    public function apagarStCopia($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarStCopia = new \App\bib\Models\BibApagarStCopia();
           $apagarStCopia->apagarStCopia($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma Situação!</div>";
        }
        $UrlDestino = URLADM . 'situacoes/listar';
        header("Location: $UrlDestino");
    }

}
