<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxCadastrarPatrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class CxCadastrarPatrimonio
{

    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadPatrimonio(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->verPatrimonioCad();
            if ($this->Resultado) {
                $this->inserirPatrimonio();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirPatrimonio()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['ano'] = date("Y");
        $this->Dados['usuario_id'] = (int) $_SESSION['usuario_id'];

        $cadPatrimonio = new \App\adms\Models\helper\AdmsCreate;
        $cadPatrimonio->exeCreate("cx_patrimonio", $this->Dados);
        //var_dump($this->Dados);
        if ($cadPatrimonio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Patrimonio cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Patrimonio não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    private function verPatrimonioCad()
    {
        $listarPatrimonio = new \App\adms\Models\helper\AdmsRead();
        $listarPatrimonio->fullRead("SELECT * FROM cx_patrimonio
        WHERE patrimonio=:patrimonio
        LIMIT :limit", "limit=1&patrimonio={$this->Dados['patrimonio']}");
        if ($listarPatrimonio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Patrimonio {$this->Dados['patrimonio']} Já existe!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_imv, imovel FROM cx_imovel ORDER BY id_imv ASC");
        $registro['imv'] = $listar->getResultado();

        $this->Resultado = [
            'imv' => $registro['imv']
        ];

        return $this->Resultado;
    }
}
