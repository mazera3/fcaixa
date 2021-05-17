<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarEditora {

    private $DadosId;
    private $Resultado;
    private $DadosEditora;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarEditora($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verBiblioCad();
        if ($this->Resultado) {
            $this->verEditora();
            if ($this->DadosEditora) {
                $this->apagaEditora();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Editora não foi apagada!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Editora não pode ser apagada, há bibliografias cadastradas com esta editora!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaEditora() {
        $apagarEditora = new \App\adms\Models\helper\AdmsDelete();
        $apagarEditora->exeDelete("bib_editora", "WHERE ed_id=:ed_id", "ed_id={$this->DadosId}");
        if ($apagarEditora->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/editora/' . $this->DadosId . '/' . $this->DadosEditora[0]['logo_imagem'], 'app/bib/assets/imagens/editora/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Editora apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Editora não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    private function verBiblioCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT ed.ed_id FROM bib_editora ed
                INNER JOIN bib_biblio bib ON bib.editora_id=ed.ed_id
                WHERE bib.editora_id=:editora_id
                LIMIT :limit", "editora_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Editora não pode ser apagado, há bibliografias cadastradas com esta editora!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verEditora() {
        $verEditora = new \App\adms\Models\helper\AdmsRead();
        $verEditora->fullRead("SELECT ed.logo_imagem FROM bib_editora ed
                WHERE ed.ed_id =:ed_id LIMIT :limit", "ed_id=" . $this->DadosId . "&limit=1");
        $this->DadosEditora = $verEditora->getResultado();
    }

}
