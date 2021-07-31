<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarContaEnergia
{

    private $DadosId;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarConta($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        $apagarConta = new \App\adms\Models\helper\AdmsDelete();
        $apagarConta->exeDelete("cx_conta_energia", "WHERE id_ene =:id_mer", "id_mer={$this->DadosId}");
        if ($apagarConta->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Conta apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }
}