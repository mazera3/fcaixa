<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibVerColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibVerColecao {

    private $Resultado;
    private $DadosId;

    public function verColecao($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verColecao = new \App\adms\Models\helper\AdmsRead();
        $verColecao->fullRead("SELECT col.* FROM bib_colecao col
                WHERE col.col_id =:col_id LIMIT :limit", "col_id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verColecao->getResultado();
        return $this->Resultado;
    }

    public function contarColecao() {
        $contarColecao = new \App\adms\Models\helper\AdmsRead();
        $contarColecao->fullRead("SELECT col.col_id,
      COUNT(bib.colecao_id) AS cont, col.*
      FROM  bib_biblio bib
      INNER JOIN bib_colecao col ON col.col_id=bib.colecao_id
      GROUP BY col.col_id
      ORDER BY col.col_id ASC");
        $this->Resultado = $contarColecao->getResultado();
        return $this->Resultado;
    }

    public function qtColecao() {
        $qtColecao = new \App\adms\Models\helper\AdmsRead();
        $qtColecao->fullRead("SELECT COUNT(col_id) AS num_result FROM bib_colecao");
        $this->Resultado = $qtColecao->getResultado();
        return $this->Resultado;
    }

}
