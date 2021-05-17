<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarMunicipio {

    private $Resultado;
    private $Dados;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadMunicipio(array $Dados) {
        $this->Dados = $Dados;

        $this->Foto = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Foto['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirMunicipio();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Foto);

        if ($valImagem->getResultado()) {
            $this->inserirMunicipio();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirMunicipio() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['municipio'] = ucwords($this->Dados['municipio']);

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['bandeira'] = $slugImg->nomeSlug($this->Foto['name']);

        $cadMunicipio = new \App\adms\Models\helper\AdmsCreate;
        $cadMunicipio->exeCreate("bib_municipio", $this->Dados);

        if ($cadMunicipio->getResultado()) {
            if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Município cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['mun_id'] = $cadMunicipio->getResultado();
                $this->uploadFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O município não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function uploadFoto() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/municipio/' . $this->Dados['mun_id'] . '/', $this->Dados['bandeira'], 270, 180);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Bairro cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este municipio não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT uf_id, nome nome_uf FROM bib_uf ORDER BY nome_uf ASC");
        $registro['uf'] = $listar->getResultado();


        $this->Resultado = ['uf' => $registro['uf']];

        return $this->Resultado;
    }

}
