<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarAutor {

    private $Resultado;
    private $Dados;
    private $Logo;
    private $VazioEmail;
    private $VazioEndereco;
    private $VazioEstado;
    private $VazioPais;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadAutor(array $Dados) {
        $this->Dados = $Dados;

        $this->VazioEmail = $this->Dados['email'];
        unset($this->Dados['email']);
        // if (!empty($this->VazioEmail)) {
        //     $this->valEmail();
        // }

        $this->VazioEstado = $this->Dados['id_uf'];
        unset($this->Dados['id_uf']);

        $this->VazioPais = $this->Dados['id_pais'];
        unset($this->Dados['id_pais']);

        $this->VazioEndereco = $this->Dados['endereco'];
        unset($this->Dados['endereco']);

        $this->Logo = $this->Dados['foto_nova'];
        unset($this->Dados['foto_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirAutor();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirAutor();
        } else {
            $this->Resultado = false;
        }
    }

    /*
      private function valEmail() {
      $valEmail = new \App\bib\Models\helper\BibEmail();
      $valEmail->valEmail($this->Dados['email']);

      $valEmailUnico = new \App\bib\Models\helper\BibEmailUnico();
      $valEmailUnico->valEmailUnico($this->Dados['email']);

      if (($valEmail->getResultado()) AND ($valEmailUnico->getResultado())) {
      $this->inserirAutor();
      } else {
      $this->Resultado = false;
      }
      }
     */

    private function inserirAutor() {
        $this->Dados['email'] = $this->VazioEmail;
        $this->Dados['id_uf'] = $this->VazioEstado;
        $this->Dados['id_pais'] = $this->VazioPais;
        $this->Dados['endereco'] = $this->VazioEndereco;

        $this->Dados['created'] = date("Y-m-d H:i:s");

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['foto_imagem'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadAutor = new \App\adms\Models\helper\AdmsCreate;
        $cadAutor->exeCreate("bib_autores", $this->Dados);

        if ($cadAutor->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Autor cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['aut_id'] = $cadAutor->getResultado();
                $this->uploadLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O autor não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    private function uploadLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/autor/' . $this->Dados['aut_id'] . '/', $this->Dados['foto_imagem'], 120, 180);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Autor cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este autor não foi cadastrado!!</div>";
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
