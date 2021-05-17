<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarStLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarStLeitor {

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado() {
        return $this->Resultado;
    }

    public function verStLeitor($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verStLeitor = new \App\adms\Models\helper\AdmsRead();
        $verStLeitor->fullRead("SELECT stl.* FROM bib_sits_leitores stl
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verStLeitor->getResultado();
        return $this->Resultado;
    }

    public function altStLeitor(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditStLeitor();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditStLeitor() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");

        $upAltStLeitor = new \App\adms\Models\helper\AdmsUpdate();
        $upAltStLeitor->exeUpdate("bib_sits_leitores", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltStLeitor->getResultado()) {
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
