<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarPais
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarPais {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    public function verPais($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verPais = new \App\adms\Models\helper\AdmsRead();
        $verPais->fullRead("SELECT p.* FROM bib_pais p
                WHERE pais_id =:pais_id LIMIT :limit", "pais_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPais->getResultado();
        return $this->Resultado;
    }

    public function altPais(array $Dados) {
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
            $this->updateEditPais();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['bandeira'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/pais/' . $this->Dados['pais_id'] . '/', $this->Dados['bandeira'], 270, 180);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/pais/' . $this->Dados['pais_id'] . '/' . $this->ImgAntiga);
                $this->updateEditPais();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditPais() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['sigla'] = strtoupper($this->Dados['sigla']); // tudo maiúsculo
        $this->Dados['nome_pais'] = ucwords($this->Dados['nome_pais']); // 1ª letra de cada palavra maiúsculo
        $upAltPais = new \App\adms\Models\helper\AdmsUpdate();
        $upAltPais->exeUpdate("bib_pais", $this->Dados, "WHERE pais_id =:pais_id", "pais_id=" . $this->Dados['pais_id']);
        if ($upAltPais->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Pais atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Pais não foi atualizado!</div>";
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
