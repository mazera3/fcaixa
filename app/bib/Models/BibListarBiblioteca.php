<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarBiblioteca
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
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'listar-biblioteca/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_biblioteca) AS num_result FROM bib_biblioteca");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarBiblioteca = new \App\adms\Models\helper\AdmsRead();
        $listarBiblioteca->fullRead("SELECT bi.* FROM bib_biblioteca bi
                ORDER BY id_biblioteca ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblioteca->getResultado();
        return $this->Resultado;
    }

}
