<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarMaterial
{

    private $DadosId;

    public function apagarMaterial($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarMaterial = new \App\bib\Models\BibApagarMaterial();
           $apagarMaterial->apagarMaterial($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de material!</div>";
        }
        $UrlDestino = URLADM . 'material/listar';
        header("Location: $UrlDestino");
    }

}
