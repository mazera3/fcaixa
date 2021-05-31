<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerBiblioteca {

    private $Resultado;
    private $DadosId;

    public function verBiblioteca($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verBiblioteca = new \App\adms\Models\helper\AdmsRead();
        $verBiblioteca->fullRead("SELECT bi.*, cr.cor cor_cr FROM bib_biblioteca bi
            INNER JOIN adms_cors cr ON cr.id=bi.tema
            WHERE id_biblioteca =:id_biblioteca LIMIT :limit", "id_biblioteca=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verBiblioteca->getResultado();
        return $this->Resultado;
    }

}
