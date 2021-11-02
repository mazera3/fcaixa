<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarPatrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarPatrimonio
{

    private $DadosId;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarPatrimonio($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $apagarPatrimonio = new \App\adms\Models\helper\AdmsDelete();
        $apagarPatrimonio->exeDelete("cx_patrimonio", "WHERE id_pat=:id_pat", "id_pat={$this->DadosId}");
        if ($apagarPatrimonio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Patrimonio apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Patrimonio não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }
}
