<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListarEmprestimos
 *
 * @copyright (c) year, Édio Mazera
 */
class ListarEmprestimos {

    private $LeitorId;

    public function listarEmprestimos() {
        $this->LeitorId = filter_input(INPUT_GET, "lt", FILTER_SANITIZE_NUMBER_INT);
        
        if (!empty($this->LeitorId)) {
        
            $listEmp = new \App\bib\Models\BibRetirarCopia();
            $this->Dados['verEmp'] = $listEmp->listarEmp($this->LeitorId);
        
            $UrlDestino = URLADM . "ver-leitor/ver-leitor/$this->LeitorId";
            header("Location: $UrlDestino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Nenhu empréstimo encontrado!</div>";
            $UrlDestino = URLADM . "ver-leitor/ver-leitor/$this->LeitorId";
            header("Location: $UrlDestino");
        }
    }

}
