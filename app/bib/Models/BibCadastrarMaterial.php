<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarMaterial {

    private $Resultado;
    private $Dados;
    private $Logo;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadMaterial(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirMaterial();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirMaterial();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirMaterial() {
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['arq_imagem'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadMaterial = new \App\adms\Models\helper\AdmsCreate;
        $cadMaterial->exeCreate("bib_tipo_material", $this->Dados);

        if ($cadMaterial->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Material cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['cod_id'] = $cadMaterial->getResultado();
                $this->valLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O material não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    private function valLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/material/' . $this->Dados['cod_id'] . '/', $this->Dados['arq_imagem'], 30, 30);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Material cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este material não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

}
