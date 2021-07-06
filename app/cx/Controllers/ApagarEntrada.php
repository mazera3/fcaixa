<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarEntrada
{

    private $DadosId;

    public function apagarEntrada($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarEntrada = new \App\cx\Models\CxApagarEntrada();
           $apagarEntrada->apagarEntrada($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Entrada!</div>";
        }
        $UrlDestino = URLADM . 'entrada/listar';
        header("Location: $UrlDestino");
    }

}
