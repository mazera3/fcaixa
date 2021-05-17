<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListarHistorico
 *
 * @copyright (c) year, Édio Mazera
 */
class ListarHistorico {

    private $LeitorId;

    public function listarHistorico() {
        $this->LeitorId = filter_input(INPUT_GET, "leitor", FILTER_SANITIZE_NUMBER_INT);
        
        if (!empty($this->LeitorId)) {
        
            $listHist = new \App\bib\Models\BibRetirarCopia();
            $this->Dados['listHist'] = $listHist->listarHist($this->LeitorId);
        
            $UrlDestino = URLADM . "ver-leitor/ver-leitor/$this->LeitorId";
            header("Location: $UrlDestino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Nenhu historico encontrado!</div>";
            $UrlDestino = URLADM . "ver-leitor/ver-leitor/$this->LeitorId";
            header("Location: $UrlDestino");
        }
    }

}
