<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarSaida
{

    private $DadosId;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarSaida($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        $apagarSaida = new \App\adms\Models\helper\AdmsDelete();
        $apagarSaida->exeDelete("cx_saida", "WHERE id_sai =:id_sai", "id_sai={$this->DadosId}");
        if ($apagarSaida->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Saida apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Saida não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }
}