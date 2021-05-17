<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarMunicipio {

    private $DadosId;
    private $Resultado;
    private $DadosMunicipio;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarMunicipio($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verLeitorCad();
        if ($this->Resultado) {
            $this->verMunicipio();
            if ($this->DadosMunicipio) {
                $this->apagaMunicipio();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Município não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O municipio não pode ser apagado, há itens cadastrados com este municipio!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaMunicipio() {

        $apagarMunicipio = new \App\adms\Models\helper\AdmsDelete();
        $apagarMunicipio->exeDelete("bib_municipio", "WHERE mun_id =:mun_id", "mun_id={$this->DadosId}");
        if ($apagarMunicipio->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/municipio/' . $this->DadosId . '/' . $this->DadosMunicipio[0]['bandeira'], 'app/bib/assets/imagens/municipio/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Município apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Município não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }

    private function verLeitorCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT mun.mun_id FROM bib_municipio mun
                INNER JOIN bib_leitor lt ON lt.id_mun=mun.mun_id
                WHERE lt.id_mun =:id_mun
                LIMIT :limit", "id_mun=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O municipio não pode ser apagado, há leitores cadastrados com este municipio!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
            $this->verBairroCad();
        }
    }

    private function verBairroCad() {
        $verBairro = new \App\adms\Models\helper\AdmsRead();
        $verBairro->fullRead("SELECT mun.mun_id FROM bib_municipio mun
                INNER JOIN bib_bairro br ON br.id_mun=mun.mun_id
                WHERE br.id_mun =:id_mun
                LIMIT :limit", "id_mun=" . $this->DadosId . "&limit=2");
        if ($verBairro->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O municipio não pode ser apagado, há bairros cadastrados com este municipio!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verMunicipio() {
        $verMunicipio = new \App\adms\Models\helper\AdmsRead();
        $verMunicipio->fullRead("SELECT mun.bandeira FROM bib_municipio mun
                WHERE mun.mun_id =:mun_id LIMIT :limit", "mun_id=" . $this->DadosId . "&limit=1");
        $this->DadosMunicipio = $verMunicipio->getResultado();
    }

}
