<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarPais
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarPais
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarPais($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'pais/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(pais_id) AS num_result FROM bib_pais");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarPais = new \App\adms\Models\helper\AdmsRead();
        $listarPais->fullRead("SELECT p.* FROM bib_pais p
                ORDER BY nome_pais ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarPais->getResultado();
        return $this->Resultado;
    }

}
