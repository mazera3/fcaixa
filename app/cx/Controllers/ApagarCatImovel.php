<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarCatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarCatImovel
{

    private $DadosId;

    public function apagarCatImovel($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarCatImovel = new \App\cx\Models\CxApagarCatImovel();
           $apagarCatImovel->apagarCatImovel($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de CatImovel!</div>";
        }
        $UrlDestino = URLADM . 'cat-imovel/listar';
        header("Location: $UrlDestino");
    }

}
