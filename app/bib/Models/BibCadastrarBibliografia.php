<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibCadastrarBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarBibliografia {

    private $Resultado;
    private $Dados;
    private $Capa;
    private $VazioChamada;
    private $VazioIsbn;
    private $VazioSubtitulo;
    private $VazioAno;
    private $VazioTopicos;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadBibliografia(array $Dados) {
        $this->Dados = $Dados;

        $this->VazioChamada = $this->Dados['chamada'];
        unset($this->Dados['chamada']);

        $this->VazioIsbn = $this->Dados['isbn'];
        unset($this->Dados['isbn']);

        $this->VazioSubtitulo = $this->Dados['sub_titulo'];
        unset($this->Dados['sub_titulo']);

        $this->VazioAno = $this->Dados['ano'];
        unset($this->Dados['ano']);

        $this->VazioTopicos = $this->Dados['topicos'];
        unset($this->Dados['topicos']);

        $this->Capa = $this->Dados['capa_nova'];
        unset($this->Dados['capa_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);


        if ($valCampoVazio->getResultado()) {

            if (!empty($this->Capa['name'])) {
                $this->validarImagem();
            } else {
                $this->inserirBibliografia();
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function validarImagem() {
        $valImagem = new \App\bib\Models\helper\BibValidarImg();
        $valImagem->validarImagem($this->Capa);

        if ($valImagem->getResultado()) {
            $this->inserirBibliografia();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirBibliografia() {

        $this->Dados['chamada'] = $this->VazioChamada;
        $this->Dados['isbn'] = $this->VazioIsbn;
        $this->Dados['sub_titulo'] = $this->VazioSubtitulo;
        $this->Dados['ano'] = $this->VazioAno;
        $this->Dados['topicos'] = $this->VazioTopicos;

        $this->Dados['created'] = date("Y-m-d H:i:s");
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['capa_imagem'] = $slugImg->nomeSlug($this->Capa['name']);

        $cadBibliografia = new \App\adms\Models\helper\AdmsCreate;
        $cadBibliografia->exeCreate("bib_biblio", $this->Dados);

        if ($cadBibliografia->getResultado()) {
            if (empty($this->Capa['name'])) {

                $_SESSION['msg'] = "<div class='alert alert-success'>Bibliografia cadastrada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['bib_id'] = $cadBibliografia->getResultado();
                $this->uploadCapa();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Bibliografia não foi cadastrada!</div>";
            $this->Resultado = false;
        }
    }

    private function uploadCapa() {
        $uploadImg = new \App\bib\Models\helper\BibUploadImgRed();
        $uploadImg->uploadImagem($this->Capa, 'app/bib/assets/imagens/bibliografia/' . $this->Dados['bib_id'] . '/', $this->Dados['capa_imagem'], 180, 270);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Bibliografia cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Bibliografia não foi cadastrada!!</div>";
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
