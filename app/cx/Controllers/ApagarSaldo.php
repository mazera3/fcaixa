<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarSaldo
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarSaldo
{

    private $DadosId;

    public function apagarSaldo($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarSaldo = new \App\cx\Models\CxApagarSaldo();
           $apagarSaldo->apagarSaldo($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Saldo!</div>";
        }
        $UrlDestino = URLADM . 'saldo/listar';
        header("Location: $UrlDestino");
    }

}
