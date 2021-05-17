<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarStCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarStCopia {

    private $Resultado;
    private $Dados;
    

    function getResultado() {
        return $this->Resultado;
    }

    public function cadStCopia(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirStCopia();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirStCopia() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['nome'] = ucwords($this->Dados['nome']);

        $cadStCopia = new \App\adms\Models\helper\AdmsCreate;
        $cadStCopia->exeCreate("bib_sits_copia", $this->Dados);

        if ($cadStCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Situação não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id cor_id, nome nome_cor, cor cor_cor FROM adms_cors ORDER BY id ASC");
        $registro['cor'] = $listar->getResultado();

        $this->Resultado = ['cor' => $registro['cor']];

        return $this->Resultado;
    }

}
