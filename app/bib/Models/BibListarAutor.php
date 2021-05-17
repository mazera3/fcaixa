<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarAutor
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarAutor($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'autores/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(aut_id) AS num_result FROM bib_autores");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarAutor = new \App\adms\Models\helper\AdmsRead();
        $listarAutor->fullRead("SELECT * FROM bib_autores ORDER BY autor ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarAutor->getResultado();
        return $this->Resultado;
    }
    
    public function qtAutor()
    {
        $qtAutor = new \App\adms\Models\helper\AdmsRead();
        $qtAutor->fullRead("SELECT COUNT(aut_id) AS num_result FROM bib_autores");
        $this->Resultado = $qtAutor->getResultado();
        return $this->Resultado;
    }

}
