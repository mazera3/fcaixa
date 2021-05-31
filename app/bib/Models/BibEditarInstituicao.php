<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarInstituicao {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Logo;

    function getResultado() {
        return $this->Resultado;
    }

    public function verInstituicao($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verInstituicao = new \App\adms\Models\helper\AdmsRead();
        $verInstituicao->fullRead("SELECT es.* FROM bib_instituicao es
                WHERE id_instituicao =:id_instituicao LIMIT :limit", "id_instituicao=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verInstituicao->getResultado();
        return $this->Resultado;
    }

    public function altInstituicao(array $Dados) {
        $this->Dados = $Dados;
        
        $this->Logo = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->uploadLogo();
        } else {
            $this->Resultado = false;
        }
    }
    
    private function uploadLogo()
    {
        if (empty($this->Logo['name'])) {
            $this->updateEditInstituicao();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['logo_instituicao'] = $slugImg->nomeSlug($this->Logo['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/instituicao/' . $this->Dados['id_instituicao'] . '/', $this->Dados['logo_instituicao'], 200, 200);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/instituicao/' . $this->Dados['id_instituicao'] . '/' . $this->ImgAntiga);
                $this->updateEditInstituicao();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditInstituicao() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['sigla_instituicao'] = strtoupper($this->Dados['sigla_instituicao']); // tudo maiúsculo
        $this->Dados['nome_instituicao'] = ucwords($this->Dados['nome_instituicao']); // 1ª letra de cada palavra maiúsculo
       
        
        $upAltInstituicao = new \App\adms\Models\helper\AdmsUpdate();
        $upAltInstituicao->exeUpdate("bib_instituicao", $this->Dados, "WHERE id_instituicao =:id_instituicao", "id_instituicao=" . $this->Dados['id_instituicao']);
        if ($upAltInstituicao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Instituicao atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A instituicao não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }
}
