<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerAutor {

    private $Resultado;
    private $DadosId;

    public function verAutor($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verAutor = new \App\adms\Models\helper\AdmsRead();
        $verAutor->fullRead("SELECT aut.*, uf.uf, uf.nome nome_uf, p.nome_pais, p.sigla FROM bib_autores aut
                INNER JOIN bib_uf uf ON uf.uf_id=aut.id_uf
                INNER JOIN bib_pais p ON p.pais_id=aut.id_pais
                WHERE aut.aut_id =:aut_id LIMIT :limit", "aut_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verAutor->getResultado();
        return $this->Resultado;
    }

}
