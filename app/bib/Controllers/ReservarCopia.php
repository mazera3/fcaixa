<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RetirarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class ReservarCopia {

    private $LeitorId;
    private $CopiaId;
    private $DiasRet;

    public function reservarCopia() {
        $this->LeitorId = filter_input(INPUT_GET, "lt", FILTER_SANITIZE_NUMBER_INT);
        $this->CopiaId = filter_input(INPUT_GET, "cp", FILTER_SANITIZE_NUMBER_INT);
        $this->DiasRet = filter_input(INPUT_GET, "cl", FILTER_SANITIZE_NUMBER_INT);
        
        if (!empty($this->LeitorId) AND !empty($this->CopiaId) AND !empty($this->DiasRet)) {
        
            $resCopia = new \App\bib\Models\BibReservarCopia();
            $resCopia->resCopia($this->CopiaId, $this->LeitorId, $this->DiasRet);
        
            $UrlDestino = URLADM . "ver-leitor/ver-leitor/$this->LeitorId?lt=$this->LeitorId";
            header("Location: $UrlDestino");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta cópia não foi encontrada!</div>";
            $UrlDestino = URLADM . "ver-leitor/ver-leitor/$this->LeitorId";
            header("Location: $UrlDestino");
        }
    }

}
