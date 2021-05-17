<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibApagarClassificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibApagarClassificacao {

    private $DadosId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarClassificacao($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $this->verLeitorCad();
        if ($this->Resultado) {
            $this->apagaClassificacao();
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Classificação não foi apagada!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaClassificacao() {
        $apagarClassificacao = new \App\adms\Models\helper\AdmsDelete();
        $apagarClassificacao->exeDelete("bib_classificacao", "WHERE clas_id =:clas_id", "clas_id={$this->DadosId}");
        if ($apagarClassificacao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Classificacao apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Classificacao não foi apagado!!</div>";
            $this->Resultado = false;
        }
    }

// verifica se há leitores cadastrados com essa classificação
    private function verLeitorCad() {
        $verLeitor = new \App\adms\Models\helper\AdmsRead();
        $verLeitor->fullRead("SELECT cl.clas_id FROM bib_classificacao cl
                INNER JOIN bib_leitor lt ON lt.classificacao_id=cl.clas_id
                WHERE lt.classificacao_id =:classificacao_id
                LIMIT :limit", "classificacao_id=" . $this->DadosId . "&limit=2");
        if ($verLeitor->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Classificação não pode ser apagada, há <b>Leitores</b> cadastrados com esta Classificação!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
