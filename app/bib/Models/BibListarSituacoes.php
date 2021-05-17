<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarSituacoes
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarSituacoes
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 100;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarSituacoesBiblio($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'situacoes/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM bib_sits_biblio");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarSituacoesBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarSituacoesBiblio->fullRead("SELECT stb.adms_cor_id stb_cor, stb.id id_stb, stb.nome nome_stb, cr.cor cor_cr FROM bib_sits_biblio stb
                INNER JOIN adms_cors cr ON cr.id=stb.adms_cor_id
                ORDER BY stb.id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarSituacoesBiblio->getResultado();
        return $this->Resultado;
    }
    
    public function listarSituacoesCopia($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'situacoes/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM bib_sits_copia");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarSituacoesCopia = new \App\adms\Models\helper\AdmsRead();
        $listarSituacoesCopia->fullRead("SELECT stc.adms_cor_id stc_cor, stc.id id_stc, stc.nome nome_stc, cr.cor stc_cor_cr FROM bib_sits_copia stc
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                ORDER BY stc.id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarSituacoesCopia->getResultado();
        return $this->Resultado;
    }
    
    public function listarSituacoesLeitor($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'situacoes/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM bib_sits_leitores");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarSituacoesLeitor = new \App\adms\Models\helper\AdmsRead();
        $listarSituacoesLeitor->fullRead("SELECT stl.adms_cor_id stl_cor, stl.id id_stl, stl.nome nome_stl, cr.cor stl_cor_cr FROM bib_sits_leitores stl
                INNER JOIN adms_cors cr ON cr.id=stl.adms_cor_id
                ORDER BY stl.id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarSituacoesLeitor->getResultado();
        return $this->Resultado;
    }

}
