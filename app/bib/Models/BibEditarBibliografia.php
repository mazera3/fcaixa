<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarBibliografia {

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Capa;
    private $ImgAntiga;
    private $VazioSubtitulo;
    private $VazioChamada;
    private $VazioIsbn;
    private $VazioAno;
    private $VazioTopicos;

    function getResultado() {
        return $this->Resultado;
    }

    public function verBibliografia($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verBibliografia = new \App\adms\Models\helper\AdmsRead();
        $verBibliografia->fullRead("SELECT bib.* FROM bib_biblio bib
                WHERE bib_id =:bib_id LIMIT :limit", "bib_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verBibliografia->getResultado();
        return $this->Resultado;
    }

    public function altBibliografia(array $Dados) {
        $this->Dados = $Dados;

        $this->VazioSubtitulo = $this->Dados['sub_titulo'];
        unset($this->Dados['sub_titulo']);
        
        $this->VazioChamada = $this->Dados['chamada'];
        unset($this->Dados['chamada']);
        
        $this->VazioIsbn = $this->Dados['isbn'];
        unset($this->Dados['isbn']);
        
        $this->VazioAno = $this->Dados['ano'];
        unset($this->Dados['ano']);
        
        $this->VazioTopicos = $this->Dados['topicos'];
        unset($this->Dados['topicos']);

        $this->Capa = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valCapa();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCapa() {
        if (empty($this->Capa['name'])) {
            $this->updateEditBibliografia();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['capa_imagem'] = $slugImg->nomeSlug($this->Capa['name']);

            $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
            $uploadImg->uploadImagem($this->Capa, 'app/bib/assets/imagens/bibliografia/' . $this->Dados['bib_id'] . '/', $this->Dados['capa_imagem'], 180, 270);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('app/bib/assets/imagens/bibliografia/' . $this->Dados['bib_id'] . '/' . $this->ImgAntiga);
                $this->updateEditBibliografia();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditBibliografia() {
        $this->Dados['sub_titulo'] = $this->VazioSubtitulo;
        $this->Dados['chamada'] = $this->VazioChamada;
        $this->Dados['isbn'] = $this->VazioIsbn;
        $this->Dados['ano'] = $this->VazioAno;
        $this->Dados['topicos'] = $this->VazioTopicos;

        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltBibliografia = new \App\adms\Models\helper\AdmsUpdate();
        $upAltBibliografia->exeUpdate("bib_biblio", $this->Dados, "WHERE bib_id =:bib_id", "bib_id=" . $this->Dados['bib_id']);
        if ($upAltBibliografia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Bibliografia atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A bibliografia não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT cod_id, descricao descricao_mat FROM bib_tipo_material ORDER BY descricao ASC");
        $registro['mat'] = $listar->getResultado();

        $listar->fullRead("SELECT col_id, descricao descricao_col FROM bib_colecao ORDER BY descricao ASC");
        $registro['col'] = $listar->getResultado();

        $listar->fullRead("SELECT aut_id, autor FROM bib_autores ORDER BY autor ASC");
        $registro['aut'] = $listar->getResultado();

        $listar->fullRead("SELECT id, nome nome_sit FROM bib_sits_biblio ORDER BY nome ASC");
        $registro['sit'] = $listar->getResultado();
        
        $listar->fullRead("SELECT ed_id, editora FROM bib_editora ORDER BY editora ASC");
        $registro['ed'] = $listar->getResultado();

        $this->Resultado = [
            'mat' => $registro['mat'], 
            'col' => $registro['col'], 
            'aut' => $registro['aut'], 
            'sit' => $registro['sit'],
            'ed' => $registro['ed']
                ];

        return $this->Resultado;
    }

}
