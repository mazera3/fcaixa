<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarMunicipio {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    public function verMunicipio($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verMunicipio = new \App\adms\Models\helper\AdmsRead();
        $verMunicipio->fullRead("SELECT mun.* FROM bib_municipio mun
                WHERE mun_id =:mun_id LIMIT :limit", "mun_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verMunicipio->getResultado();
        return $this->Resultado;
    }

    public function altMunicipio(array $Dados) {
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
            $this->updateEditMunicipio();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['bandeira'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/municipio/' . $this->Dados['mun_id'] . '/', $this->Dados['bandeira'], 270, 180);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/municipio/' . $this->Dados['mun_id'] . '/' . $this->ImgAntiga);
                $this->updateEditMunicipio();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditMunicipio() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['municipio'] = ucwords($this->Dados['municipio']);
        
        $upAltMunicipio = new \App\adms\Models\helper\AdmsUpdate();
        $upAltMunicipio->exeUpdate("bib_municipio", $this->Dados, "WHERE mun_id =:mun_id", "mun_id=" . $this->Dados['mun_id']);
        if ($upAltMunicipio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Municipio atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O municipio não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT uf_id, nome nome_uf FROM bib_uf ORDER BY nome_uf ASC");
        $registro['uf'] = $listar->getResultado();


        $this->Resultado = ['uf' => $registro['uf']];

        return $this->Resultado;
    }
}
