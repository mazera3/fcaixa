<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxCadastrarCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class CxCadastrarCategoria
{

    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadCategoria(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirCategoria();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirCategoria()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $cadCategoria = new \App\adms\Models\helper\AdmsCreate;
        $cadCategoria->exeCreate("cx_categoria", $this->Dados);

        if ($cadCategoria->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Categoria cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Categoria não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }
}
