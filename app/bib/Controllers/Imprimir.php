<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Imprimir
 *
 * @copyright (c) year, Édio Mazera
 */
class Imprimir {

    private $DadosId;

    public function imprimir($DadosId = null) {
        $this->DadosId = (int) $DadosId;

        if (!empty($this->DadosId)) {

            $imprime = new \App\bib\Models\BibImprimir();
            $imprime->imprime($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um documento!</div>";
        }
        $UrlDestino = URLADM . 'estatisticas/listar';
        header("Location: $UrlDestino");
    }

}
