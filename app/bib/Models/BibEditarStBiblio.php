<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarStBiblio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarStBiblio {

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado() {
        return $this->Resultado;
    }

    public function verStBiblio($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verStBiblio = new \App\adms\Models\helper\AdmsRead();
        $verStBiblio->fullRead("SELECT stb.* FROM bib_sits_biblio stb
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verStBiblio->getResultado();
        return $this->Resultado;
    }

    public function altStBiblio(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditStBiblio();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditStBiblio() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");

        $upAltStBiblio = new \App\adms\Models\helper\AdmsUpdate();
        $upAltStBiblio->exeUpdate("bib_sits_biblio", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltStBiblio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Situação não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id cor_id, nome nome_cor, cor cor_cor FROM adms_cors ORDER BY id ASC");
        $registro['cor'] = $listar->getResultado();

        $this->Resultado = ['cor' => $registro['cor']];

        return $this->Resultado;
    }

}
