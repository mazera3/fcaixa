<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarStCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarStCopia {

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado() {
        return $this->Resultado;
    }

    public function verStCopia($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verStCopia = new \App\adms\Models\helper\AdmsRead();
        $verStCopia->fullRead("SELECT stc.* FROM bib_sits_copia stc
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verStCopia->getResultado();
        return $this->Resultado;
    }

    public function altStCopia(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditStCopia();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditStCopia() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");

        $upAltStCopia = new \App\adms\Models\helper\AdmsUpdate();
        $upAltStCopia->exeUpdate("bib_sits_copia", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltStCopia->getResultado()) {
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
