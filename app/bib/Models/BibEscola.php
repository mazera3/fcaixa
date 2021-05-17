<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEscola
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'escola/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(pais_id) AS num_result FROM bib_escola");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarPais = new \App\adms\Models\helper\AdmsRead();
        $listarPais->fullRead("SELECT es.* FROM bib_escola es
                ORDER BY nome_escola ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarPais->getResultado();
        return $this->Resultado;
    }

}
