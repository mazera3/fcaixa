<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarUf
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarUf
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarUf($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'uf/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(uf_id) AS num_result FROM bib_uf");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarUf = new \App\adms\Models\helper\AdmsRead();
        $listarUf->fullRead("SELECT uf.*, p.* FROM bib_uf uf
                INNER JOIN bib_pais p ON p.pais_id=uf.id_pais
                ORDER BY uf ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarUf->getResultado();
        return $this->Resultado;
    }

}
