<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarEscola {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Logo;

    function getResultado() {
        return $this->Resultado;
    }

    public function verEscola($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verEscola = new \App\adms\Models\helper\AdmsRead();
        $verEscola->fullRead("SELECT es.* FROM bib_escola es
                WHERE id_escola =:id_escola LIMIT :limit", "id_escola=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verEscola->getResultado();
        return $this->Resultado;
    }

    public function altEscola(array $Dados) {
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
            $this->updateEditEscola();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['logo_escola'] = $slugImg->nomeSlug($this->Logo['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/escola/' . $this->Dados['id_escola'] . '/', $this->Dados['logo_escola'], 200, 200);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/escola/' . $this->Dados['id_escola'] . '/' . $this->ImgAntiga);
                $this->updateEditEscola();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditEscola() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['sigla_escola'] = strtoupper($this->Dados['sigla_escola']); // tudo maiúsculo
        $this->Dados['nome_escola'] = ucwords($this->Dados['nome_escola']); // 1ª letra de cada palavra maiúsculo
       
        
        $upAltEscola = new \App\adms\Models\helper\AdmsUpdate();
        $upAltEscola->exeUpdate("bib_escola", $this->Dados, "WHERE id_escola =:id_escola", "id_escola=" . $this->Dados['id_escola']);
        if ($upAltEscola->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Escola atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A escola não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }
}
