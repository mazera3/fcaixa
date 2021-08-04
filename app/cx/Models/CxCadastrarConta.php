<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxCadastrarConta
 *
 * @copyright (c) year, Édio Mazera
 */
class CxCadastrarConta
{

    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadConta(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirConta();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirConta()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $slugConta = new \App\cx\Models\helper\CxSlug();
        $this->Dados['conta'] = $slugConta->nomeSlug($this->Dados['conta']);
        $this->Dados['conta'] = ucwords(trim($this->Dados['conta']));

        $cadConta = new \App\adms\Models\helper\AdmsCreate;
        $cadConta->exeCreate("cx_contas", $this->Dados);

        if ($cadConta->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Conta cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Conta não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }
}
