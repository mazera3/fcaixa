<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxCadastrarEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class CxCadastrarEntrada
{

    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadEntrada(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirEntrada();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirEntrada()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['ano'] = date("Y");

        $cadEntrada = new \App\adms\Models\helper\AdmsCreate;
        $cadEntrada->exeCreate("cx_entrada", $this->Dados);

        if ($cadEntrada->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Entrada cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Entrada não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_des, descricao FROM cx_descricao ORDER BY descricao ASC");
        $registro['des'] = $listar->getResultado();

        $listar->fullRead("SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC");
        $registro['mes'] = $listar->getResultado();

        $this->Resultado = [
            'des' => $registro['des'],
            'mes' => $registro['mes']
        ];

        return $this->Resultado;
    }
}
