<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarStCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarStCopia {

    private $DadosId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarStCopia($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verCopiaCad();
        if ($this->Resultado) {
            $this->apagaStCopia();
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Classificação não foi apagada!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaStCopia() {
        $apagarStCopia = new \App\adms\Models\helper\AdmsDelete();
        $apagarStCopia->exeDelete("bib_sits_copia", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarStCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

// verifica se há leitores cadastrados com essa classificação
    private function verCopiaCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT stc.id FROM bib_sits_copia stc
                INNER JOIN bib_copia cp ON cp.sit_copia=stc.id
                WHERE cp.sit_copia =:sit_copia
                LIMIT :limit", "sit_copia=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Situação não pode ser apagada, há <b>Copias</b> cadastradas com esta situação!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
