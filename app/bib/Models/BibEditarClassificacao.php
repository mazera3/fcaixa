<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarClassificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarClassificacao {

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado() {
        return $this->Resultado;
    }

    public function verClassificacao($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verClassificacao = new \App\adms\Models\helper\AdmsRead();
        $verClassificacao->fullRead("SELECT cl.* FROM bib_classificacao cl
                WHERE clas_id =:clas_id LIMIT :limit", "clas_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verClassificacao->getResultado();
        return $this->Resultado;
    }

    public function altClassificacao(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditClassificacao();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditClassificacao() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");

        $upAltClassificacao = new \App\adms\Models\helper\AdmsUpdate();
        $upAltClassificacao->exeUpdate("bib_classificacao", $this->Dados, "WHERE clas_id =:clas_id", "clas_id=" . $this->Dados['clas_id']);
        if ($upAltClassificacao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Classificacao atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Classificacao não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

}
