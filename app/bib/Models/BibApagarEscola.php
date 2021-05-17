<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarEscola {

    private $DadosId;
    private $Resultado;
    private $DadosEscola;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarEscola($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verEscola();
        if ($this->DadosEscola) {
            $this->apagaEscola();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Escola não foi apagado!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaEscola() {

        $apagarEscola = new \App\adms\Models\helper\AdmsDelete();
        $apagarEscola->exeDelete("bib_escola", "WHERE id_escola =:id_escola", "id_escola={$this->DadosId}");
        if ($apagarEscola->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/escola/' . $this->DadosId . '/' . $this->DadosEscola[0]['logo_escola'], 'app/bib/assets/imagens/escola/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Escola apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Escola não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    public function contaEscolaCad() {
        $contEscola = new \App\adms\Models\helper\AdmsRead();
        $contEscola->fullRead("SELECT COUNT(id_escola) AS num_escola FROM bib_escola");
        $this->Resultado = $contEscola->getResultado();
        return $this->Resultado;
    }

    private function verEscola() {
        $verEscola = new \App\adms\Models\helper\AdmsRead();
        $verEscola->fullRead("SELECT es.logo_escola FROM bib_escola es
                WHERE es.id_escola =:id_escola LIMIT :limit", "id_escola=" . $this->DadosId . "&limit=1");
        $this->DadosEscola = $verEscola->getResultado();
    }

}
