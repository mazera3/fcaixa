<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarClassificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarClassificacao {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadClassificacao(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirClassificacao();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirClassificacao() {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $this->Dados['classificacao'] = ucwords($this->Dados['classificacao']); // 1ª letra de cada palavra maiúsculo

        $cadClassificacao = new \App\adms\Models\helper\AdmsCreate;
        $cadClassificacao->exeCreate("bib_classificacao", $this->Dados);

        if ($cadClassificacao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Classificação cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Classificação não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

}
