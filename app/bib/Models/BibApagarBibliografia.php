<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarBibliografia {

    private $DadosId;
    private $Resultado;
    private $DadosBibliografia;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarBibliografia($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verCopiaCad();
        if ($this->Resultado) {
            $this->verBibliografia();
            if ($this->DadosBibliografia) {
                $this->apagaBibliografia();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Bibliografia não foi apagada!</div>";
                $this->Resultado = false;
            }
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Bibliografia não pode ser apagado, há itens cadastrados com este país!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaBibliografia() {
        $apagarBibliografia = new \App\adms\Models\helper\AdmsDelete();
        $apagarBibliografia->exeDelete("bib_biblio", "WHERE bib_id =:bib_id", "bib_id={$this->DadosId}");
        if ($apagarBibliografia->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/bibliografia/' . $this->DadosId . '/' . $this->DadosBibliografia[0]['capa_imagem'], 'app/bib/assets/imagens/bibliografia/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Bibliografia apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bibliografia não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }
// verifica se há cópias cadastrados com essa bibliografia
    private function verCopiaCad() {
        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT bib.bib_id FROM bib_biblio bib
                INNER JOIN bib_copia cp ON cp.cop_bib_id=bib.bib_id
                WHERE cp.cop_bib_id =:cop_bib_id
                LIMIT :limit", "cop_bib_id=" . $this->DadosId . "&limit=2");
        if ($verCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Bibliografia não pode ser apagada, há <b>cópias</b> cadastradas com esta Bibliografia!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verBibliografia() {
        $verBibliografia = new \App\adms\Models\helper\AdmsRead();
        $verBibliografia->fullRead("SELECT bib.capa_imagem FROM bib_biblio bib
                WHERE bib.bib_id =:bib_id LIMIT :limit", "bib_id=" . $this->DadosId . "&limit=1");
        $this->DadosBibliografia = $verBibliografia->getResultado();
    }

}
