<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarBairro {

    private $Resultado;
    private $Dados;
    private $Logo;
    private $VazioMun;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadBairro(array $Dados) {
        $this->Dados = $Dados;

        $this->VazioMun = $this->Dados['id_mun'];
        unset($this->Dados['id_mun']);

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirBairro();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirBairro();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirBairro() {
        $this->Dados['id_mun'] = $this->VazioMun;
        $this->Dados['bairro'] = ucwords($this->Dados['bairro']);
        $this->Dados['created'] = date("Y-m-d H:i:s");

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadBairro = new \App\adms\Models\helper\AdmsCreate;
        $cadBairro->exeCreate("bib_bairro", $this->Dados);

        if ($cadBairro->getResultado()) {
            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Bairro cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['br_id'] = $cadBairro->getResultado();
                $this->valLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O bairro não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function valLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/bairro/' . $this->Dados['br_id'] . '/', $this->Dados['logo_imagem'], 270, 180);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Bairro cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este bairro não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT mun_id, municipio FROM bib_municipio ORDER BY municipio ASC");
        $registro['munic'] = $listar->getResultado();

        $this->Resultado = ['munic' => $registro['munic']];

        return $this->Resultado;
    }

}
