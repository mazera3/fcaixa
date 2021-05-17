<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarColecao {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarColecao($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'colecao/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(col_id) AS num_result FROM bib_colecao");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarColecao = new \App\adms\Models\helper\AdmsRead();
        $listarColecao->fullRead("SELECT * FROM bib_colecao ORDER BY col_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarColecao->getResultado();
        return $this->Resultado;
    }

   
      public function contarColecao()
      {
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
