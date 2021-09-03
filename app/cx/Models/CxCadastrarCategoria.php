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
            $this->verCategoriaCad();
            if ($this->Resultado) {
                $this->inserirCategoria();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirCategoria()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $cadCategoria = new \App\adms\Models\helper\AdmsCreate;
        $cadCategoria->exeCreate("cx_categoria", $this->Dados);
        //var_dump($this->Dados);
        if ($cadCategoria->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Categoria cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Categoria não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    private function verCategoriaCad()
    {
        $listarCategoria = new \App\adms\Models\helper\AdmsRead();
        $listarCategoria->fullRead("SELECT * FROM cx_categoria
        WHERE categoria=:categoria
        LIMIT :limit", "limit=1&categoria={$this->Dados['categoria']}");
        if ($listarCategoria->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Categoria {$this->Dados['categoria']} Já existe!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }
}
