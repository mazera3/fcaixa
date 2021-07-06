<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarDescricao
{

    private $DadosId;

    public function apagarDescricao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarDescricao = new \App\cx\Models\CxApagarDescricao();
           $apagarDescricao->apagarDescricao($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Descricao!</div>";
        }
        $UrlDestino = URLADM . 'descricao/listar';
        header("Location: $UrlDestino");
    }

}
