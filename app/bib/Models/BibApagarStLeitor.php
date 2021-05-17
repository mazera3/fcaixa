<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarStLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarStLeitor {

    private $DadosId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarStLeitor($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verLeitorCad();
        if ($this->Resultado) {
            $this->apagaStLeitor();
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Classificação não foi apagada!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaStLeitor() {
        $apagarStLeitor = new \App\adms\Models\helper\AdmsDelete();
        $apagarStLeitor->exeDelete("bib_sits_leitores", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarStLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

// verifica se há leitores cadastrados com essa situação
    private function verLeitorCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT stl.id FROM bib_sits_leitores stl
                INNER JOIN bib_leitor lt ON lt.sits_leitor_id=stl.id
                WHERE lt.sits_leitor_id =:sits_leitor_id
                LIMIT :limit", "sits_leitor_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Situação não pode ser apagada, há <b>Leitors</b> cadastradas com esta situação!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
