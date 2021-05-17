<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarLeitor {

    private $DadosId;
    private $Resultado;
    private $DadosLeitor;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarLeitor($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verCopiaCad();
        if ($this->Resultado) {
            $this->verLeitor();
            if ($this->DadosLeitor) {
                $this->apagaLeitor();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Leitor não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Leitor não pode ser apagado, há itens cadastrados com este leitor!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaLeitor() {
        $apagarLeitor = new \App\adms\Models\helper\AdmsDelete();
        $apagarLeitor->exeDelete("bib_leitor", "WHERE leitor_id =:leitor_id", "leitor_id={$this->DadosId}");
        if ($apagarLeitor->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/leitor/' . $this->DadosId . '/' . $this->DadosLeitor[0]['foto_leitor'], 'app/bib/assets/imagens/leitor/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Leitor apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Leitor não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }
// verifica se há cópias cadastrados com essa bibliografia
    private function verCopiaCad() {
        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT lt.leitor_id FROM bib_leitor lt
                INNER JOIN bib_copia cp ON cp.id_leitor=lt.leitor_id
                WHERE lt.leitor_id =:id_leitor
                LIMIT :limit", "id_leitor=" . $this->DadosId . "&limit=2");
        if ($verCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Leitor não pode ser apagado, há <b>cópias</b> cadastradas com este Leitor!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verLeitor() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT lt.foto_leitor FROM bib_leitor lt
                WHERE lt.leitor_id =:leitor_id LIMIT :limit", "leitor_id=" . $this->DadosId . "&limit=1");
        $this->DadosLeitor = $verLeitor->getResultado();
    }

}
