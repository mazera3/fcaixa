<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarBairro {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $VazioMunicipio;

    function getResultado() {
        return $this->Resultado;
    }

    public function verBairro($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verBairro = new \App\adms\Models\helper\AdmsRead();
        $verBairro->fullRead("SELECT br.* FROM bib_bairro br
                WHERE br_id =:br_id LIMIT :limit", "br_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verBairro->getResultado();
        return $this->Resultado;
    }

    public function altBairro(array $Dados) {
        $this->Dados = $Dados;
        
        $this->VazioMunicipio = $this->Dados['id_mun'];
        unset($this->Dados['id_mun']);
        
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
            $this->updateEditBairro();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/bairro/' . $this->Dados['br_id'] . '/', $this->Dados['logo_imagem'], 270, 180);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/bairro/' . $this->Dados['br_id'] . '/' . $this->ImgAntiga);
                $this->updateEditBairro();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditBairro() {
        $this->Dados['id_mun'] = $this->VazioMunicipio;
        $this->Dados['bairro'] = ucwords($this->Dados['bairro']);
        
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltBairro = new \App\adms\Models\helper\AdmsUpdate();
        $upAltBairro->exeUpdate("bib_bairro", $this->Dados, "WHERE br_id =:br_id", "br_id=" . $this->Dados['br_id']);
        if ($upAltBairro->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Bairro atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O bairro não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT mun_id, municipio FROM bib_municipio ORDER BY municipio ASC");
        $registro['mun'] = $listar->getResultado();


        $this->Resultado = ['mun' => $registro['mun']];

        return $this->Resultado;
    }
}
