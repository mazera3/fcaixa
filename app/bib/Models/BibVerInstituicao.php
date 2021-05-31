<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerInstituicao {

    private $Resultado;
    private $DadosId;

    public function verInstituicao($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verInstituicao = new \App\adms\Models\helper\AdmsRead();
        $verInstituicao->fullRead("SELECT es.* FROM bib_instituicao es
            WHERE id_instituicao =:id_instituicao LIMIT :limit", "id_instituicao=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verInstituicao->getResultado();
        return $this->Resultado;
    }

}
