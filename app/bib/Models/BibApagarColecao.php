<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarColecao {

    private $DadosId;
    private $Resultado;
    private $DadosColecao;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarColecao($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verBiblioCad();
        if ($this->Resultado) {
            $this->verColecao();
            if ($this->DadosColecao) {
                $this->apagaColecao();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Colecao não foi apagada!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Colecao não pode ser apagada, há bibliografias cadastradas com esta colecao!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaColecao() {
        $apagarColecao = new \App\adms\Models\helper\AdmsDelete();
        $apagarColecao->exeDelete("bib_colecao", "WHERE col_id =:col_id", "col_id={$this->DadosId}");
        if ($apagarColecao->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/colecao/' . $this->DadosId . '/' . $this->DadosColecao[0]['logo_imagem'], 'app/bib/assets/imagens/colecao/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Colecao apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Colecao não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    private function verBiblioCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT col.col_id FROM bib_colecao col
                INNER JOIN bib_biblio bib ON bib.colecao_id=col.col_id
                WHERE bib.colecao_id =:colecao_id
                LIMIT :limit", "colecao_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A colecao não pode ser apagado, há bibliografias cadastradas com esta colecao!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verColecao() {
        $verColecao = new \App\adms\Models\helper\AdmsRead();
        $verColecao->fullRead("SELECT col.logo_imagem FROM bib_colecao col
                WHERE col.col_id =:col_id LIMIT :limit", "col_id=" . $this->DadosId . "&limit=1");
        $this->DadosColecao = $verColecao->getResultado();
    }

}
