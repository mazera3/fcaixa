<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarAutor {

    private $DadosId;
    private $Resultado;
    private $DadosAutor;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarAutor($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verBiblioCad();
        if ($this->Resultado) {
            $this->verAutor();
            if ($this->DadosAutor) {
                $this->apagaAutor();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Autor não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Autor não pode ser apagado, há bibliografias cadastradas com este autor!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaAutor() {
        $apagarAutor = new \App\adms\Models\helper\AdmsDelete();
        $apagarAutor->exeDelete("bib_autores", "WHERE aut_id=:aut_id", "aut_id={$this->DadosId}");
        if ($apagarAutor->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('app/bib/assets/imagens/autor/' . $this->DadosId . '/' . $this->DadosAutor[0]['foto_imagem'], 'app/bib/assets/imagens/autor/' . $this->DadosId);
            $_SESSION['msg'] = "<div class='alert alert-success'>Autor apagado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Autor não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }

    private function verBiblioCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT aut.aut_id FROM bib_autores aut
                INNER JOIN bib_biblio bib ON bib.autor_id=aut.aut_id
                WHERE bib.autor_id=:autor_id
                LIMIT :limit", "autor_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: O Autor não pode ser apagado, há bibliografias cadastradas com este autor!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verAutor() {
        $verAutor = new \App\adms\Models\helper\AdmsRead();
        $verAutor->fullRead("SELECT aut.foto_imagem FROM bib_autores aut
                WHERE aut.aut_id =:aut_id LIMIT :limit", "aut_id=" . $this->DadosId . "&limit=1");
        $this->DadosAutor = $verAutor->getResultado();
    }

}
