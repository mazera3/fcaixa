<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarEditora
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarEditora($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'editoras/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(ed_id) AS num_result FROM bib_editora");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarEditora = new \App\adms\Models\helper\AdmsRead();
        $listarEditora->fullRead("SELECT ed.*, uf.uf, uf.nome nome_uf, p.nome_pais, p.sigla FROM bib_editora ed
                INNER JOIN bib_uf uf ON uf.uf_id=ed.id_uf
                INNER JOIN bib_pais p ON p.pais_id=ed.id_pais
                ORDER BY editora ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarEditora->getResultado();
        return $this->Resultado;
    }

}
