<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarEntrada
{

    private $DadosId;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarEntrada($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        $apagarEntrada = new \App\adms\Models\helper\AdmsDelete();
        $apagarEntrada->exeDelete("cx_entrada", "WHERE id_ent =:id_ent", "id_ent={$this->DadosId}");
        if ($apagarEntrada->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Entrada apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Entrada não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }
}