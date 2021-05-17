<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarMunicipio
{

    private $DadosId;

    public function apagarMunicipio($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarMunicipio = new \App\bib\Models\BibApagarMunicipio();
           $apagarMunicipio->apagarMunicipio($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um município!</div>";
        }
        $UrlDestino = URLADM . 'municipio/listar';
        header("Location: $UrlDestino");
    }

}
