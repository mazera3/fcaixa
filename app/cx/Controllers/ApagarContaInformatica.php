<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarContaInformatica
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarContaInformatica
{

    private $DadosId;

    public function apagarConta($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarConta = new \App\cx\Models\CxApagarContaInformatica();
           $apagarConta->apagarConta($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Conta!</div>";
        }
        $UrlDestino = URLADM . 'conta-informatica/listar';
        header("Location: $UrlDestino");
    }

}
