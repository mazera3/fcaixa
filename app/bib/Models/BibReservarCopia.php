<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibReservarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibReservarCopia {

    private $Resultado;
    private $CopiaId;
    private $LeitorId;
    private $Dados;
    private $PageId;
    private $DiasRet;

    function getResultado() {
        return $this->Resultado;
    }

    public function resCopia($CopiaId = null, $LeitorId = null, $DiasRet = null, $Dados = null, $PageId = null) {
        $this->CopiaId = (int) $CopiaId;
        $this->LeitorId = (int) $LeitorId;
        $this->DiasRet = (int) $DiasRet;
        $this->Dados = (int) $Dados;
        $this->PageId = (int) $PageId;

        $this->verCopia();
        if ($this->Dados) {
            $this->altCopia();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível reservar a cópia!</div>";
            $this->Resultado = false;
        }
    }

    private function verCopia() {
        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT cp.* FROM bib_copia cp
                WHERE cp.cop_id =:cop_id", "cop_id={$this->CopiaId}");
        $this->Dados = $verCopia->getResultado();
    }

    private function altCopia() {
        if ($this->Dados[0]['sit_res'] == 1) {
            $this->Dados[0]['sit_res'] = 2;
            $this->Dados[0]['id_res'] = $this->LeitorId;
            $this->Dados[0]['data_res'] = date("Y-m-d");
            // Reserva por um dia após a devolução
            $this->Dados[0]['data_lib'] = date('Y-m-d', strtotime("+1 days",strtotime($this->Dados[0]['data_dev'])));
            $this->Dados[0]['modified'] = date("Y-m-d H:i:s");
            $this->upCopia();
        } elseif ($this->Dados[0]['sit_res'] == 2 AND $this->Dados[0]['id_res'] == $this->LeitorId) {
            $this->Dados[0]['sit_res'] = 1;
            $this->Dados[0]['id_res'] = null;
            $this->Dados[0]['data_res'] = null;
            $this->Dados[0]['data_lib'] = null;
            $this->Dados[0]['modified'] = date("Y-m-d H:i:s");
            $this->upCopia();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Esta cópia encontra-se emprestada!</div>";
            $this->Resultado = false;
        }
    }

    private function upCopia() {
        $upCopia = new \App\adms\Models\helper\AdmsUpdate();
        $upCopia->exeUpdate("bib_copia", $this->Dados[0], "WHERE cop_id =:cop_id", "cop_id={$this->CopiaId}");

        $c = $this->Dados[0]['cod_bar'];
        if ($upCopia->getResultado() AND $this->Dados[0]['sit_res'] == 2) {
            $_SESSION['msg'] = "<div class='alert alert-success'>A Cópia $c foi reservada com sucesso para o leitor $this->LeitorId!</div>";
            $this->Resultado = true;
        } elseif ($upCopia->getResultado() AND $this->Dados[0]['sit_res'] == 1) {
            $_SESSION['msg'] = "<div class='alert alert-info'>A Cópia $c foi liberada com sucesso pelo leitor $this->LeitorId!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível reservar a cópia!</div>";
            $this->Resultado = false;
        }
    }

}
