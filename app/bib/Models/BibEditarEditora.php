<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarEditora {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Logo;
    private $VazioEndereco;
    private $VazioEstado;
    private $VazioPais;

    function getResultado() {
        return $this->Resultado;
    }

    public function verEditora($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verEditora = new \App\adms\Models\helper\AdmsRead();
        $verEditora->fullRead("SELECT ed.* FROM bib_editora ed
                WHERE ed_id =:ed_id LIMIT :limit", "ed_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verEditora->getResultado();
        return $this->Resultado;
    }

    public function altEditora(array $Dados) {
        $this->Dados = $Dados;
        
        $this->VazioEndereco = $this->Dados['endereco'];
        unset($this->Dados['endereco']);
        
        $this->VazioEstado = $this->Dados['id_uf'];
        unset($this->Dados['id_uf']);
        
        $this->VazioPais = $this->Dados['id_pais'];
        unset($this->Dados['id_pais']);

        $this->Logo = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valLogo();
        } else {
            $this->Resultado = false;
        }
    }

    private function valLogo() {
        if (empty($this->Logo['name'])) {
            $this->updateEditEditora();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['logo_imagem'] = $slugImg->nomeSlug($this->Logo['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Logo, 'app/bib/assets/imagens/editora/' . $this->Dados['ed_id'] . '/', $this->Dados['logo_imagem'], 180, 180);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/editora/' . $this->Dados['ed_id'] . '/' . $this->ImgAntiga);
                $this->updateEditEditora();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditEditora() {
        $this->Dados['id_uf'] = $this->VazioEstado;
        $this->Dados['id_pais'] = $this->VazioPais;
        $this->Dados['endereco'] = $this->VazioEndereco;
        
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltEditora = new \App\adms\Models\helper\AdmsUpdate();
        $upAltEditora->exeUpdate("bib_editora", $this->Dados, "WHERE ed_id =:ed_id", "ed_id=" . $this->Dados['ed_id']);
        if ($upAltEditora->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Editora atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A editora não foi atualizada!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT uf_id, nome nome_uf FROM bib_uf ORDER BY nome_uf ASC");
        $registro['uf'] = $listar->getResultado();


        $listar->fullRead("SELECT pais_id, nome_pais FROM bib_pais ORDER BY nome_pais ASC");
        $registro['pais'] = $listar->getResultado();


        $this->Resultado = ['uf' => $registro['uf'],'pais' => $registro['pais']];

        return $this->Resultado;
    }

}
