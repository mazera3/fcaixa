<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarPatrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarPatrimonio
{

    private $DadosId;

    public function apagarPatrimonio($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarPatrimonio = new \App\cx\Models\CxApagarPatrimonio();
           $apagarPatrimonio->apagarPatrimonio($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um Patrimonio!</div>";
        }
        $UrlDestino = URLADM . 'patrimonio/listar';
        header("Location: $UrlDestino");
    }

}
