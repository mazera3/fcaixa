<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarInstituicao
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
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'instituicao/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_instituicao) AS num_result FROM bib_instituicao");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarInstituicao = new \App\adms\Models\helper\AdmsRead();
        $listarInstituicao->fullRead("SELECT es.* FROM bib_instituicao es
                ORDER BY id_instituicao ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarInstituicao->getResultado();
        return $this->Resultado;
    }

}
