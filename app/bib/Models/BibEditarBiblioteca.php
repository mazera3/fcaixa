<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarBiblioteca {

    private $Resultado;
    private $Dados;
    private $DadosId;
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

    public function verBiblioteca($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verBiblioteca = new \App\adms\Models\helper\AdmsRead();
        $verBiblioteca->fullRead("SELECT bi.* FROM bib_biblioteca bi
                WHERE id_biblioteca =:id_biblioteca LIMIT :limit", "id_biblioteca=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verBiblioteca->getResultado();
        return $this->Resultado;
    }

    public function altBiblioteca(array $Dados) {
        $this->Dados = $Dados;

        $this->Logo = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);
        
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
            $this->uploadLogo();
        } else {
            $this->Resultado = false;
        }
    }

    private function uploadLogo() {
        if (empty($this->Logo['name'])) {
            $this->updateEditBiblioteca();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['logo_biblioteca'] = $slugImg->nomeSlug($this->Logo['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/biblioteca/' . $this->Dados['id_biblioteca'] . '/', $this->Dados['logo_biblioteca'], 200, 200);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/biblioteca/' . $this->Dados['id_biblioteca'] . '/' . $this->ImgAntiga);
                $this->updateEditBiblioteca();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditBiblioteca() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
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
        
        $upAltBiblioteca = new \App\adms\Models\helper\AdmsUpdate();
        $upAltBiblioteca->exeUpdate("bib_biblioteca", $this->Dados, "WHERE id_biblioteca =:id_biblioteca", "id_biblioteca=" . $this->Dados['id_biblioteca']);
        if ($upAltBiblioteca->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Biblioteca atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A biblioteca não foi atualizada!</div>";
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
