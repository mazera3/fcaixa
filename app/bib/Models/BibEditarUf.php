<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarUf
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarUf {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    public function verUf($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verUf = new \App\adms\Models\helper\AdmsRead();
        $verUf->fullRead("SELECT uf.* FROM bib_uf uf
                WHERE uf_id =:uf_id LIMIT :limit", "uf_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verUf->getResultado();
        return $this->Resultado;
    }

    public function altUf(array $Dados) {
        $this->Dados = $Dados;
        
        $this->Foto = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valFoto();
        } else {
            $this->Resultado = false;
        }
    }
    
    private function valFoto()
    {
        if (empty($this->Foto['name'])) {
            $this->updateEditUf();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/uf/' . $this->Dados['uf_id'] . '/', $this->Dados['logo_imagem'], 270, 180);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/uf/' . $this->Dados['uf_id'] . '/' . $this->ImgAntiga);
                $this->updateEditUf();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditUf() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['nome'] = ucwords($this->Dados['nome']);
        $this->Dados['uf'] = strtoupper($this->Dados['uf']);
        
        $upAltUf = new \App\adms\Models\helper\AdmsUpdate();
        $upAltUf->exeUpdate("bib_uf", $this->Dados, "WHERE uf_id =:uf_id", "uf_id=" . $this->Dados['uf_id']);
        if ($upAltUf->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Estado atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O estado não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT pais_id, nome_pais FROM bib_pais ORDER BY nome_pais ASC");
        $registro['pais'] = $listar->getResultado();


        $this->Resultado = ['pais' => $registro['pais']];

        return $this->Resultado;
    }
}
