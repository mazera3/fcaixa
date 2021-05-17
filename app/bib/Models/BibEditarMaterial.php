<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarMaterial {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    public function verMaterial($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verMaterial = new \App\adms\Models\helper\AdmsRead();
        $verMaterial->fullRead("SELECT mat.* FROM bib_tipo_material mat
                WHERE cod_id =:cod_id LIMIT :limit", "cod_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verMaterial->getResultado();
        return $this->Resultado;
    }

    public function altMaterial(array $Dados) {
        $this->Dados = $Dados;

        $this->Foto = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->uploadFoto();
        } else {
            $this->Resultado = false;
        }
    }

    private function uploadFoto() {
        if (empty($this->Foto['name'])) {
            $this->updateEditMaterial();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['arq_imagem'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/material/' . $this->Dados['cod_id'] . '/', $this->Dados['arq_imagem'], 120, 120);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/material/' . $this->Dados['cod_id'] . '/' . $this->ImgAntiga);
                $this->updateEditMaterial();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditMaterial() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltMaterial = new \App\adms\Models\helper\AdmsUpdate();
        $upAltMaterial->exeUpdate("bib_tipo_material", $this->Dados, "WHERE cod_id =:cod_id", "cod_id=" . $this->Dados['cod_id']);
        if ($upAltMaterial->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Material atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O material não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

}
