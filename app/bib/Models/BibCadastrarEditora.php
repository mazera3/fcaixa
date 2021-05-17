<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarEditora {

    private $Resultado;
    private $Dados;
    private $Logo;
    private $VazioEndereco;
    private $VazioEstado;
    private $VazioPais;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadEditora(array $Dados) {
        $this->Dados = $Dados;

        $this->VazioEstado = $this->Dados['id_uf'];
        unset($this->Dados['id_uf']);

        $this->VazioPais = $this->Dados['id_pais'];
        unset($this->Dados['id_pais']);

        $this->VazioEndereco = $this->Dados['endereco'];
        unset($this->Dados['endereco']);

        $this->Logo = $this->Dados['editora_nova'];
        unset($this->Dados['editora_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirEditora();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirEditora();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirEditora() {

        $this->Dados['id_uf'] = $this->VazioEstado;
        $this->Dados['id_pais'] = $this->VazioPais;
        $this->Dados['endereco'] = $this->VazioEndereco;

        $this->Dados['created'] = date("Y-m-d H:i:s");

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadEditora = new \App\adms\Models\helper\AdmsCreate;
        $cadEditora->exeCreate("bib_editora", $this->Dados);

        if ($cadEditora->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Editora cadastrada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['ed_id'] = $cadEditora->getResultado();
                $this->uploadFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Editora não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    private function uploadFoto() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/editora/' . $this->Dados['ed_id'] . '/', $this->Dados['logo_imagem'], 120, 120);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Editora cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Editora não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT uf_id, nome FROM bib_uf ORDER BY nome ASC");
        $registro['uf'] = $listar->getResultado();

        $listar->fullRead("SELECT pais_id, nome_pais FROM bib_pais ORDER BY nome_pais ASC");
        $registro['pais'] = $listar->getResultado();


        $this->Resultado = ['uf' => $registro['uf'], 'pais' => $registro['pais']];

        return $this->Resultado;
    }

}
