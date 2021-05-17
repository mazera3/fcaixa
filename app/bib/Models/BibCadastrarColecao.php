<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarColecao {

    private $Resultado;
    private $Dados;
    private $Logo;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadColecao(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirColecao();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirColecao();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirColecao() {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadColecao = new \App\adms\Models\helper\AdmsCreate;
        $cadColecao->exeCreate("bib_colecao", $this->Dados);

        if ($cadColecao->getResultado()) {
            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Colecao cadastrada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['col_id'] = $cadColecao->getResultado();
                $this->valLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Colecao não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    private function valLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/colecao/' . $this->Dados['col_id'] . '/', $this->Dados['logo_imagem'], 180, 180);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Colecao cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta colecao não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

}
