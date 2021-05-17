<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarMunicipio
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarMunicipio($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'municipio/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(mun_id) AS num_result FROM bib_municipio");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarMunicipio = new \App\adms\Models\helper\AdmsRead();
        $listarMunicipio->fullRead("SELECT mun.*, uf.uf, uf.nome nome_uf FROM bib_municipio mun
                INNER JOIN bib_uf uf ON uf.uf_id=mun.id_uf
                ORDER BY municipio ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarMunicipio->getResultado();
        return $this->Resultado;
    }

}
