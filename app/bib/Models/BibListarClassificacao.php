<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarClassificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarClassificacao
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarClassificacao($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'classificacao/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(clas_id) AS num_result FROM bib_classificacao");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarClassificacao = new \App\adms\Models\helper\AdmsRead();
        $listarClassificacao->fullRead("SELECT cl.* FROM bib_classificacao cl
                ORDER BY cl.clas_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarClassificacao->getResultado();
        return $this->Resultado;
    }

}
