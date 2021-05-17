<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibImprimir
 *
 * @copyright (c) year, Édio Mazera
 */
class BibImprimir {

    private $DadosId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function imprimir($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $imprime = new \App\bib\Models\helper\BibImprimePdf();
        $imprime->imprimir();
        $this->Resultado = $imprime->getResultado();
        if ($this->Resultado) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Documento impresso com sucesso!</div>";
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Documento não foi impresso!</div>";
            $this->Resultado = false;
        }
    }

}
