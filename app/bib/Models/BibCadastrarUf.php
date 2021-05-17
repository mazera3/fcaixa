<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarUf
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarUf {

    private $Resultado;
    private $Dados;
    private $Logo;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadUf(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirUf();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirUf();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirUf() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['uf'] = strtoupper($this->Dados['uf']);
        $this->Dados['nome'] = ucwords($this->Dados['nome']);

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadUf = new \App\adms\Models\helper\AdmsCreate;
        $cadUf->exeCreate("bib_uf", $this->Dados);

        if ($cadUf->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Estado cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['uf_id'] = $cadUf->getResultado();
                $this->valLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Estado não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    private function valLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/uf/' . $this->Dados['uf_id'] . '/', $this->Dados['logo_imagem'], 270, 180);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Estado cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Estado não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT pais_id, nome_pais FROM bib_pais ORDER BY nome_pais ASC");
        $registro['pais'] = $listar->getResultado();


        $this->Resultado = ['pais' => $registro['pais']];

        return $this->Resultado;
    }

}
