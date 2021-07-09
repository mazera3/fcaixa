<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarSaldo
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarSaldo
{

    private $DadosId;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarSaldo($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $apagarSaldo = new \App\adms\Models\helper\AdmsDelete();
        $apagarSaldo->exeDelete("cx_saldo", "WHERE id_sal=:id_sal", "id_sal={$this->DadosId}");
        if ($apagarSaldo->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Saldo apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Saldo não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }
}
