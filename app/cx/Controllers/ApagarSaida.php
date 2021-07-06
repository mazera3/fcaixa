<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarSaida
{

    private $DadosId;

    public function apagarSaida($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarSaida = new \App\cx\Models\CxApagarSaida();
           $apagarSaida->apagarSaida($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Saida!</div>";
        }
        $UrlDestino = URLADM . 'saida/listar';
        header("Location: $UrlDestino");
    }

}
