<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarPais
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarPais {

    private $Resultado;
    private $Dados;
    private $Logo;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadPais(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirPais();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirPais() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['sigla'] = strtoupper($this->Dados['sigla']); // tudo maiúsculo
        $this->Dados['nome_pais'] = ucwords($this->Dados['nome_pais']); // 1ª letra de cada palavra maiúsculo
        
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['bandeira'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadPais = new \App\adms\Models\helper\AdmsCreate;
        $cadPais->exeCreate("bib_pais", $this->Dados);

        if ($cadPais->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Pais cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['pais_id'] = $cadPais->getResultado();
                $this->valLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Pais não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

    private function valLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/pais/' . $this->Dados['pais_id'] . '/', $this->Dados['bandeira'], 270, 180);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Pais cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Pais não foi cadastrado!!</div>";
            $this->Resultado = false;
        }
    }

}
