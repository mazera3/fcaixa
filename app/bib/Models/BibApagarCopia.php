<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarCopia {

    private $DadosId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarCopia($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verCopiaCad();
        if ($this->Resultado) {
            $this->apagaCopia();
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Copia não foi apagada!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaCopia() {
        $apagarCopia = new \App\adms\Models\helper\AdmsDelete();
        $apagarCopia->exeDelete("bib_copia", "WHERE cop_id =:cop_id", "cop_id={$this->DadosId}");
        if ($apagarCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Copia apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Copia não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

// verifica se há cópias emprestadas
    private function verCopiaCad() {
        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT cp.cop_id FROM bib_copia cp
                WHERE cp.sit_copia >= 2 AND
                cp.cop_id =:cop_id
                LIMIT :limit", "&cop_id=" . $this->DadosId . "&limit=2");
        if ($verCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Copia não pode ser apagada, há <b>Emprestimos ou Reservas</b> desta Copia!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
