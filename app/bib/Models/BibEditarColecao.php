<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarColecao {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    public function verColecao($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verColecao = new \App\adms\Models\helper\AdmsRead();
        $verColecao->fullRead("SELECT col.* FROM bib_colecao col
                WHERE col_id =:col_id LIMIT :limit", "col_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verColecao->getResultado();
        return $this->Resultado;
    }

    public function altColecao(array $Dados) {
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
            $this->updateEditColecao();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/colecao/' . $this->Dados['col_id'] . '/', $this->Dados['logo_imagem'], 120, 120);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/colecao/' . $this->Dados['col_id'] . '/' . $this->ImgAntiga);
                $this->updateEditColecao();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditColecao() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltColecao = new \App\adms\Models\helper\AdmsUpdate();
        $upAltColecao->exeUpdate("bib_colecao", $this->Dados, "WHERE col_id =:col_id", "col_id=" . $this->Dados['col_id']);
        if ($upAltColecao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Colecao atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A colecao não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

}
