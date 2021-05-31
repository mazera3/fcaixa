<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibConfigurar
 *
 * @copyright (c) year, Édio Mazera
 */
class BibConfigurar {

    private $Resultado;
    private $DadosId;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function config($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $conf = new \App\adms\Models\helper\AdmsRead();
        $conf->fullRead("SELECT cf.*, bi.nome_bib FROM bib_confs_site cf
            INNER JOIN bib_biblioteca bi ON bi.id_biblioteca=cf.id_site
                WHERE id =:id LIMIT :limit", "id=1&limit=1");
        $this->Resultado = $conf->getResultado();
        return $this->Resultado;
    }
    
    public function altConfig(array $Dados) {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->configBiblioteca();
        } else {
            $this->Resultado = false;
        }
    }

    

    private function configBiblioteca() {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->Dados['modified'] = date("Y-m-d H:i:s");

        $conf = new \App\adms\Models\helper\AdmsUpdate();
        $conf->exeUpdate("bib_confs_site", $this->Dados, "WHERE id=:id", "id=1");

        if ($conf->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Biblioteca configurada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Biblioteca não foi configurada!!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_biblioteca, nome_bib FROM bib_biblioteca ORDER BY id_biblioteca ASC");
        $registro['site'] = $listar->getResultado();

        $this->Resultado = ['site' => $registro['site']];
        return $this->Resultado;
    }

}
