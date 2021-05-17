<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarEscola {

    private $Resultado;
    private $Dados;
    private $Logo;
    private $VazioEndereco;
    private $VazioEnsino;
    private $VazioEmail;
    private $VazioFone;
    private $VazioHorario;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadEscola(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $this->VazioEndereco = $this->Dados['endereco_escola'];
        unset($this->Dados['endereco_escola']);
        
        $this->VazioEnsino = $this->Dados['tipo_ensino'];
        unset($this->Dados['tipo_ensino']);
        
        $this->VazioEmail = $this->Dados['email_escola'];
        unset($this->Dados['email_escola']);
        
        $this->VazioFone = $this->Dados['fone_escola'];
        unset($this->Dados['fone_escola']);
        
        $this->VazioHorario = $this->Dados['horario_escola'];
        unset($this->Dados['horario_escola']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirEscola();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirEscola();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirEscola() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['sigla_escola'] = strtoupper($this->Dados['sigla_escola']); // tudo maiúsculo
        $this->Dados['nome_escola'] = ucwords($this->Dados['nome_escola']); // 1ª letra de cada palavra maiúsculo
        $this->Dados['endereco_escola'] = $this->VazioEndereco;
        $this->Dados['tipo_ensino'] = $this->VazioEnsino;
        $this->Dados['email_escola'] = $this->VazioEmail;
        $this->Dados['fone_escola'] = $this->VazioFone;
        $this->Dados['horario_escola'] = $this->VazioHorario;

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['logo_escola'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadEscola = new \App\adms\Models\helper\AdmsCreate;
        $cadEscola->exeCreate("bib_escola", $this->Dados);

        if ($cadEscola->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Escola cadastrada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id_escola'] = $cadEscola->getResultado();
                $this->updateLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Escola não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    private function updateLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/escola/' . $this->Dados['id_escola'] . '/', $this->Dados['logo_escola'], 200, 200);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Escola cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Escola não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

}
