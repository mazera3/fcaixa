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
            $this->verDescricaoCad();
            if ($this->Resultado) {
                $this->inserirDescricao();
            }
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

    private function verDescricaoCad()
    {
        $listarCategoria = new \App\adms\Models\helper\AdmsRead();
        $listarCategoria->fullRead("SELECT * FROM cx_descricao
        WHERE descricao=:descricao
        LIMIT :limit", "limit=1&descricao={$this->Dados['descricao']}");
        if ($listarCategoria->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A descricao {$this->Dados['descricao']} Já existe!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
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
