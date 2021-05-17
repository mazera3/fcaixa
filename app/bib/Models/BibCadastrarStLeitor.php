<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarStLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarStLeitor {

    private $Resultado;
    private $Dados;
    

    function getResultado() {
        return $this->Resultado;
    }

    public function cadStLeitor(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirStLeitor();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirStLeitor() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['nome'] = ucwords($this->Dados['nome']);

        $cadStLeitor = new \App\adms\Models\helper\AdmsCreate;
        $cadStLeitor->exeCreate("bib_sits_leitores", $this->Dados);

        if ($cadStLeitor->getResultado()) {
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
