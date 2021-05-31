<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarInstituicao {

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

    public function cadInstituicao(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $this->VazioEndereco = $this->Dados['endereco_instituicao'];
        unset($this->Dados['endereco_instituicao']);
        
        $this->VazioEnsino = $this->Dados['tipo_ensino'];
        unset($this->Dados['tipo_ensino']);
        
        $this->VazioEmail = $this->Dados['email_instituicao'];
        unset($this->Dados['email_instituicao']);
        
        $this->VazioFone = $this->Dados['fone_instituicao'];
        unset($this->Dados['fone_instituicao']);
        
        $this->VazioHorario = $this->Dados['horario_instituicao'];
        unset($this->Dados['horario_instituicao']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirInstituicao();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirInstituicao();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirInstituicao() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['sigla_instituicao'] = strtoupper($this->Dados['sigla_instituicao']); // tudo maiúsculo
        $this->Dados['nome_instituicao'] = ucwords($this->Dados['nome_instituicao']); // 1ª letra de cada palavra maiúsculo
        $this->Dados['endereco_instituicao'] = $this->VazioEndereco;
        $this->Dados['tipo_ensino'] = $this->VazioEnsino;
        $this->Dados['email_instituicao'] = $this->VazioEmail;
        $this->Dados['fone_instituicao'] = $this->VazioFone;
        $this->Dados['horario_instituicao'] = $this->VazioHorario;

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['logo_instituicao'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadInstituicao = new \App\adms\Models\helper\AdmsCreate;
        $cadInstituicao->exeCreate("bib_instituicao", $this->Dados);

        if ($cadInstituicao->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Instituicao cadastrada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id_instituicao'] = $cadInstituicao->getResultado();
                $this->updateLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Instituicao não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    private function updateLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/instituicao/' . $this->Dados['id_instituicao'] . '/', $this->Dados['logo_instituicao'], 200, 200);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Instituicao cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Instituicao não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

}
