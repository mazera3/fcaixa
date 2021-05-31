<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarBiblioteca {

    private $DadosId;
    private $Resultado;
    private $DadosBiblioteca;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarBiblioteca($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verBiblioteca();
        if ($this->DadosBiblioteca) {
            $this->apagaBiblioteca();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Biblioteca não foi apagado!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaBiblioteca() {

        $apagarBiblioteca = new \App\adms\Models\helper\AdmsDelete();
        $apagarBiblioteca->exeDelete("bib_biblioteca", "WHERE id_biblioteca =:id_biblioteca", "id_biblioteca={$this->DadosId}");
        if ($apagarBiblioteca->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/biblioteca/' . $this->DadosId . '/' . $this->DadosBiblioteca[0]['logo_biblioteca'], 'app/bib/assets/imagens/biblioteca/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Biblioteca apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Biblioteca não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    public function contaBibliotecaCad() {
        $contBiblioteca = new \App\adms\Models\helper\AdmsRead();
        $contBiblioteca->fullRead("SELECT COUNT(id_biblioteca) AS num_biblioteca FROM bib_biblioteca");
        $this->Resultado = $contBiblioteca->getResultado();
        return $this->Resultado;
    }

    private function verBiblioteca() {
        $verBiblioteca = new \App\adms\Models\helper\AdmsRead();
        $verBiblioteca->fullRead("SELECT bi.logo_biblioteca FROM bib_biblioteca bi
                WHERE bi.id_biblioteca =:id_biblioteca LIMIT :limit", "id_biblioteca=" . $this->DadosId . "&limit=1");
        $this->DadosBiblioteca = $verBiblioteca->getResultado();
    }

}
