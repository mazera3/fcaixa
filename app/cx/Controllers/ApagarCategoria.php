<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarCategoria
{

    private $DadosId;

    public function apagarCategoria($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarCategoria = new \App\cx\Models\CxApagarCategoria();
           $apagarCategoria->apagarCategoria($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Categoria!</div>";
        }
        $UrlDestino = URLADM . 'categoria/listar';
        header("Location: $UrlDestino");
    }

}
