<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

use PDO;

/**
 * Description of BibCadastrarMarc21
 *
 * @copyright (c) year, Édio Mazera
 */
class BibCadastrarMarc21 {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function cadMarc21(array $Dados) {
        $this->Dados = $Dados;

       // foreach ($this->Dados as $dados) {
           // var_dump($dados);
           //foreach ($dados as $key => $val) { }
           $cadMarc = new \App\adms\Models\helper\AdmsCreate;
           $cadMarc->exeCreate("bib_marc21", $this->Dados);
       // }

        if ($cadMarc->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT mun_id, municipio FROM bib_municipio ORDER BY municipio ASC");
        $registro['munic'] = $listar->getResultado();

        $this->Resultado = ['munic' => $registro['munic']];

        return $this->Resultado;
    }

}
