<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxCadastrarSaldo
 *
 * @copyright (c) year, Édio Mazera
 */
class CxCadastrarSaldo
{

    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadSaldo(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirSaldo();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirSaldo()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        
        $cadSaldo = new \App\adms\Models\helper\AdmsCreate;
        $cadSaldo->exeCreate("cx_saldo", $this->Dados);

        if ($cadSaldo->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Saldo cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Saldo não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC");
        $registro['mes'] = $listar->getResultado();

        $this->Resultado = ['mes' => $registro['mes']];

        return $this->Resultado;
    }
}
