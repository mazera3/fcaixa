<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarContaEnergia
{

    private $DadosId;

    public function apagarConta($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarConta = new \App\cx\Models\CxApagarContaEnergia();
           $apagarConta->apagarConta($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Conta!</div>";
        }
        $UrlDestino = URLADM . 'conta-energia/listar';
        header("Location: $UrlDestino");
    }

}
