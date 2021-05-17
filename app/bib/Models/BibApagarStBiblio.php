<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarStBiblio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarStBiblio {

    private $DadosId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarStBiblio($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verBiblioCad();
        if ($this->Resultado) {
            $this->apagaStBiblio();
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Classificação não foi apagada!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaStBiblio() {
        $apagarStBiblio = new \App\adms\Models\helper\AdmsDelete();
        $apagarStBiblio->exeDelete("bib_sits_biblio", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarStBiblio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

// verifica se há leitores cadastrados com essa classificação
    private function verBiblioCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT stb.id FROM bib_sits_biblio stb
                INNER JOIN bib_biblio bib ON bib.sit_id=stb.id
                WHERE bib.sit_id =:sit_id
                LIMIT :limit", "sit_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Situação não pode ser apagada, há <b>Bibliografias</b> cadastrados com esta situação!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
