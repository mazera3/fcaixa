<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarBiblioteca {

    private $Resultado;
    private $Dados;
    private $Logo;
    private $VazioResponsavel_2;
    private $VazioEmail_2;
    private $VazioHorarioEsp;
    private $VazioEndereco;
    private $VazioFoneBib;
    private $VazioEmailBib;
    private $VazioWhatsApp;
    private $VazioTema;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadBiblioteca(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $this->VazioResponsavel_2 = $this->Dados['resp_bib_2'];
        unset($this->Dados['resp_bib_2']);
        
        $this->VazioEmail_2 = $this->Dados['email_res_2'];
        unset($this->Dados['email_res_2']);
        
        $this->VazioHorarioEsp = $this->Dados['horario_esp'];
        unset($this->Dados['horario_esp']);
        
        $this->VazioEndereco = $this->Dados['endereco_bib'];
        unset($this->Dados['endereco_bib']);
        
        $this->VazioFoneBib = $this->Dados['fone_bib'];
        unset($this->Dados['fone_bib']);
        
        $this->VazioEmailBib = $this->Dados['email_bib'];
        unset($this->Dados['email_bib']);
        
        $this->VazioWhatsApp = $this->Dados['whatsapp'];
        unset($this->Dados['whatsapp']);
        
        $this->VazioTema = $this->Dados['tema'];
        unset($this->Dados['tema']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Logo['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirBiblioteca();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Logo);

        if ($valImagem->getResultado()) {
            $this->inserirBiblioteca();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirBiblioteca() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        // 1ª letra de cada palavra maiúsculo
        $this->Dados['nome_bib'] = ucwords($this->Dados['nome_bib']);
        $this->Dados['nome_inst'] = ucwords($this->Dados['nome_inst']);
        //
        $this->Dados['resp_bib_2'] = $this->VazioResponsavel_2;
        $this->Dados['email_res_2'] = $this->VazioEmail_2;
        $this->Dados['horario_esp'] = $this->VazioHorarioEsp;
        $this->Dados['endereco_bib'] = $this->VazioEndereco;
        $this->Dados['fone_bib'] = $this->VazioFoneBib;
        $this->Dados['email_bib'] = $this->VazioEmailBib;
        $this->Dados['whatsapp'] = $this->VazioWhatsApp;
        $this->Dados['tema'] = $this->VazioTema;

        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['logo_biblioteca'] = $slugImg->nomeSlug($this->Logo['name']);

        $cadBiblioteca = new \App\adms\Models\helper\AdmsCreate;
        $cadBiblioteca->exeCreate("bib_biblioteca", $this->Dados);

        if ($cadBiblioteca->getResultado()) {

            if (empty($this->Logo['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Biblioteca cadastrada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id_biblioteca'] = $cadBiblioteca->getResultado();
                $this->updateLogo();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Biblioteca não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }

    private function updateLogo() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/biblioteca/' . $this->Dados['id_biblioteca'] . '/', $this->Dados['logo_biblioteca'], 200, 200);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Biblioteca cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Biblioteca não foi cadastrada!!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id cor_id, nome nome_cor, cor cor_cor FROM adms_cors ORDER BY id ASC");
        $registro['tema'] = $listar->getResultado();

        $this->Resultado = ['tema' => $registro['tema']];
        return $this->Resultado;
    }

}
