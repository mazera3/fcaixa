<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxCadastrarDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class CxCadastrarDescricao
{

    private $Resultado;
    private $Dados;
    private $Logo;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadDescricao(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirDescricao();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirDescricao()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $cadDescricao = new \App\adms\Models\helper\AdmsCreate;
        $cadDescricao->exeCreate("cx_descricao", $this->Dados);

        if ($cadDescricao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Descricao cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Descricao não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_cat, categoria FROM cx_categoria ORDER BY categoria ASC");
        $registro['cat'] = $listar->getResultado();

        $this->Resultado = ['cat' => $registro['cat']];

        return $this->Resultado;
    }
}
