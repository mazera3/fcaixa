<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarAutor {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $VazioEmail;
    private $VazioEndereco;

    function getResultado() {
        return $this->Resultado;
    }

    public function verAutor($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verAutor = new \App\adms\Models\helper\AdmsRead();
        $verAutor->fullRead("SELECT aut.* FROM bib_autores aut
                WHERE aut_id =:aut_id LIMIT :limit", "aut_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verAutor->getResultado();
        return $this->Resultado;
    }

    public function altAutor(array $Dados) {
        $this->Dados = $Dados;
        
        $this->VazioEmail = $this->Dados['email'];
        unset($this->Dados['email']);
        
        $this->VazioEndereco = $this->Dados['endereco'];
        unset($this->Dados['endereco']);

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

    private function valFoto() {
        if (empty($this->Foto['name'])) {
            $this->updateEditAutor();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['foto_imagem'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'app/bib/assets/imagens/autor/' . $this->Dados['aut_id'] . '/', $this->Dados['foto_imagem'], 180, 270);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/autor/' . $this->Dados['aut_id'] . '/' . $this->ImgAntiga);
                $this->updateEditAutor();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditAutor() {
        $this->Dados['email'] = $this->VazioEmail;
        $this->Dados['endereco'] = $this->VazioEndereco;
        
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltAutor = new \App\adms\Models\helper\AdmsUpdate();
        $upAltAutor->exeUpdate("bib_autores", $this->Dados, "WHERE aut_id =:aut_id", "aut_id=" . $this->Dados['aut_id']);
        if ($upAltAutor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Autor atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O autor não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT uf_id, nome FROM bib_uf ORDER BY nome ASC");
        $registro['uf'] = $listar->getResultado();
        
        $listar->fullRead("SELECT pais_id, nome_pais FROM bib_pais ORDER BY nome_pais ASC");
        $registro['pais'] = $listar->getResultado();


        $this->Resultado = ['uf' => $registro['uf'],'pais' => $registro['pais']];

        return $this->Resultado;
    }

}
