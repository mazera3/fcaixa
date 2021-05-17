<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarUf
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarUf {

    private $DadosId;
    private $Resultado;
    private $DadosUf;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarUf($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verMunicipioCad();
        if ($this->Resultado) {
            $this->verUf();
            if ($this->DadosUf) {
                $this->apagaUf();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Estado não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Estado não pode ser apagado, há itens cadastrados com este estado!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaUf() {

        $apagarUf = new \App\adms\Models\helper\AdmsDelete();
        $apagarUf->exeDelete("bib_uf", "WHERE uf_id =:uf_id", "uf_id={$this->DadosId}");
        if ($apagarUf->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/uf/' . $this->DadosId . '/' . $this->DadosUf[0]['logo_imagem'], 'app/bib/assets/imagens/uf/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Estado apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Estado não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }

    private function verMunicipioCad() {
        $verMunicipio = new \App\adms\Models\helper\AdmsRead();
        $verMunicipio->fullRead("SELECT uf.uf_id FROM bib_uf uf
                INNER JOIN bib_municipio mun ON mun.id_uf=uf.uf_id
                WHERE mun.id_uf =:id_uf
                LIMIT :limit", "id_uf=" . $this->DadosId . "&limit=2");
        if ($verMunicipio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Estado não pode ser apagado, há municipios cadastrados com este estado!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
            $this->verEditoraCad();
        }
    }

    private function verEditoraCad() {
        $verEditora = new \App\adms\Models\helper\AdmsRead();
        $verEditora->fullRead("SELECT uf.uf_id FROM bib_uf uf
                INNER JOIN bib_editora ed ON ed.id_uf=uf.uf_id
                WHERE ed.id_uf =:id_uf
                LIMIT :limit", "id_uf=" . $this->DadosId . "&limit=2");
        if ($verEditora->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O estado não pode ser apagado, há editoras cadastradas com este estado!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verUf() {
        $verUf = new \App\adms\Models\helper\AdmsRead();
        $verUf->fullRead("SELECT uf.logo_imagem FROM bib_uf uf
                WHERE uf.uf_id =:uf_id LIMIT :limit", "uf_id=" . $this->DadosId . "&limit=1");
        $this->DadosUf = $verUf->getResultado();
    }

}
