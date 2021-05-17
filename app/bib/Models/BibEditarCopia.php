<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEditarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEditarCopia {

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado() {
        return $this->Resultado;
    }

    public function verCopia($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT cp.* FROM bib_copia cp
                WHERE cop_id =:cop_id LIMIT :limit", "cop_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verCopia->getResultado();
        return $this->Resultado;
    }

    public function altCopia(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditCopia();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditCopia() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");

        $upAltCopia = new \App\adms\Models\helper\AdmsUpdate();
        $upAltCopia->exeUpdate("bib_copia", $this->Dados, "WHERE cop_id =:cop_id", "cop_id=" . $this->Dados['cop_id']);
        if ($upAltCopia->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Copia atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Copia não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }
    
    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id stc_id, nome nome_stc FROM bib_sits_copia ORDER BY nome ASC");
        $registro['stc'] = $listar->getResultado();


        $this->Resultado = ['stc' => $registro['stc']];

        return $this->Resultado;
    }

}
