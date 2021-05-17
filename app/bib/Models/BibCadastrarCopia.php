<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarCopia {

    private $Resultado;
    private $Dados;
    private $VazioDescricao;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadCopia(array $Dados) {
        $this->Dados = $Dados;

        $this->VazioDescricao = $this->Dados['descricao'];
        unset($this->Dados['descricao']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            //$this->inserirCopia();
            $this->valCodBarras();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCodBarras() {
        $valCodBarras = new \App\bib\Models\helper\BibValCodBarras();
        $valCodBarras->valCodBarras($this->Dados['cod_bar']);

        if (( $valCodBarras->getResultado())) {
            $this->inserirCopia();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirCopia() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['descricao'] = $this->VazioDescricao;

        //$this->Dados['cop_bib_id'] = $this->Dados['cop_bib_id'];

        $cadCopia = new \App\adms\Models\helper\AdmsCreate;
        $cadCopia->exeCreate("bib_copia", $this->Dados);

        if ($cadCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Cópia cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Cópia não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

}
