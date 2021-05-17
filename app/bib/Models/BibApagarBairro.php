<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarBairro {

    private $DadosId;
    private $Resultado;
    private $DadosBairro;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarBairro($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verLeitorCad();
        if ($this->Resultado) {
            $this->verBairro();
            if ($this->DadosBairro) {
                $this->apagaBairro();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Bairro não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Bairro não pode ser apagado, há leitores cadastrados com este bairro!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaBairro() {
        $apagarBairro = new \App\adms\Models\helper\AdmsDelete();
        $apagarBairro->exeDelete("bib_bairro", "WHERE br_id =:br_id", "br_id={$this->DadosId}");
        if ($apagarBairro->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/bairro/' . $this->DadosId . '/' . $this->DadosBairro[0]['logo_imagem'], 'app/bib/assets/imagens/bairro/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Bairro apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bairro não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }

    private function verLeitorCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT br.br_id FROM bib_bairro br
                INNER JOIN bib_leitor lt ON lt.bairro_id=br.br_id
                WHERE lt.bairro_id =:bairro_id
                LIMIT :limit", "bairro_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O bairro não pode ser apagado, há leitores cadastrados com este bairro!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verBairro() {
        $verBairro = new \App\adms\Models\helper\AdmsRead();
        $verBairro->fullRead("SELECT br.logo_imagem FROM bib_bairro br
                WHERE br.br_id =:br_id LIMIT :limit", "br_id=" . $this->DadosId . "&limit=1");
        $this->DadosBairro = $verBairro->getResultado();
    }

}
