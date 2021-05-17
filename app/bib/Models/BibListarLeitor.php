<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibListarLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibListarLeitor {

    private $Dados;
    private $Resultado;
    private $PageId;
    private $LimiteResultado = 20;
    private $ResultadoPg;
    private $SituacaoLt;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function pesquisarLeitores($PageId = null, $Dados = null) {
        $this->PageId = (int) $PageId;
        $this->Dados = $Dados;
        $this->Dados['nome'] = trim($this->Dados['nome']);
        $this->Dados['matricula'] = trim($this->Dados['matricula']);
        $this->Dados['chave'] = trim($this->Dados['chave']);

        $_SESSION['pesqLeitorNome'] = $this->Dados['nome'];
        $_SESSION['pesqLeitorMatricula'] = $this->Dados['matricula'];
        $_SESSION['pesqLeitorChave'] = $this->Dados['chave'];

        if (!empty($this->Dados['nome'])) {
            $this->pesquisarLeitorNome();
        } elseif (!empty($this->Dados['matricula'])) {
            $this->pesquisarLeitorMatricula();
        } elseif (!empty($this->Dados['chave'])) {
            $this->pesquisarLeitorChave();
        } return $this->Resultado;
    }

    public function listarLeitor($PageId = null, $SituacaoLt = null) {
        $this->PageId = (int) $PageId;
        $this->SituacaoLt = (int) $SituacaoLt; // = 10;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'leitores/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(leitor_id) AS num_result FROM bib_leitor lt
                INNER JOIN bib_sits_leitores stl ON stl.id=lt.sits_leitor_id
                WHERE lt.sits_leitor_id<={$this->SituacaoLt}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarLeitor = new \App\adms\Models\helper\AdmsRead();
        $listarLeitor->fullRead("SELECT lt.*,
                stl.nome nome_stc,
                cr.cor cor_cr
                FROM bib_leitor lt
                INNER JOIN bib_sits_leitores stl ON stl.id=lt.sits_leitor_id
                INNER JOIN adms_cors cr ON cr.id=stl.adms_cor_id
                INNER JOIN bib_classificacao clas ON clas.clas_id=lt.classificacao_id
                WHERE lt.sits_leitor_id<={$this->SituacaoLt} 
                ORDER BY leitor_id, primeiro_nome, ultimo_nome ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarLeitor->getResultado();
        return $this->Resultado;
    }

    // pesquisa por parte do nome ou sobrenome
    private function pesquisarLeitorNome() {

        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'leitores/listar', '?nome=' . $this->Dados['nome']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(leitor_id) AS num_result FROM bib_leitor
                WHERE primeiro_nome LIKE '%' :primeiro_nome '%' OR
                ultimo_nome LIKE '%' :ultimo_nome '%' ", "primeiro_nome={$this->Dados['nome']}&ultimo_nome={$this->Dados['nome']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT lt.leitor_id, lt.cod_barras_leitor, lt.primeiro_nome, lt.ultimo_nome, lt.email, stc.nome nome_stc, cr.cor cor_cr
                FROM bib_leitor lt
                INNER JOIN bib_sits_leitores stc ON stc.id=lt.sits_leitor_id
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE primeiro_nome LIKE '%' :primeiro_nome '%' OR ultimo_nome LIKE '%' :ultimo_nome '%'
                ORDER BY leitor_id ASC LIMIT :limit OFFSET :offset", "primeiro_nome={$this->Dados['nome']}&ultimo_nome={$this->Dados['nome']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

    // pesquisa por parte da matricula
    private function pesquisarLeitorMatricula() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'leitores/listar', '?matricula=' . $this->Dados['matricula']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(leitor_id) AS num_result FROM bib_leitor
                WHERE cod_barras_leitor LIKE '%' :matricula '%' ", "matricula={$this->Dados['matricula']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT lt.leitor_id, lt.cod_barras_leitor, lt.primeiro_nome, lt.ultimo_nome, lt.email, stc.nome nome_stc, cr.cor cor_cr
                FROM bib_leitor lt
                INNER JOIN bib_sits_leitores stc ON stc.id=lt.sits_leitor_id
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE cod_barras_leitor LIKE '%' :matricula '%'
                ORDER BY leitor_id ASC LIMIT :limit OFFSET :offset", "matricula={$this->Dados['matricula']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

    // pesquisa por palavra chave
    private function pesquisarLeitorChave() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'leitores/listar', '?chave=' . $this->Dados['chave']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(leitor_id) AS num_result FROM bib_leitor
                INNER JOIN bib_municipio cid ON cid.mun_id=lt.id_mun
                INNER JOIN bib_bairro br ON br.br_id=lt.bairro_id
                WHERE email LIKE '%' :chave '%' OR 
                cid.municipio LIKE '%' :chave '%' OR 
                br.bairro LIKE '%' :chave '%' OR 
                endereco LIKE '%' :chave '%' OR 
                fone LIKE '%' :chave '%' OR 
                primeiro_nome LIKE '%' :chave '%' OR
                ultimo_nome LIKE '%' :chave '%' OR
                celular LIKE '%' :chave '%' OR 
                cod_barras_leitor LIKE '%' :chave '%'
                ", "chave={$this->Dados['chave']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT lt.*, cid.municipio, stc.nome nome_stc, cr.cor cor_cr
                FROM bib_leitor lt
                INNER JOIN bib_municipio cid ON cid.mun_id=lt.id_mun
                INNER JOIN bib_bairro br ON br.br_id=lt.bairro_id
                INNER JOIN bib_sits_leitores stc ON stc.id=lt.sits_leitor_id
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE lt.email LIKE '%' :chave '%' OR 
                cid.municipio LIKE '%' :chave '%' OR
                br.bairro LIKE '%' :chave '%' OR 
                lt.endereco LIKE '%' :chave '%' OR 
                lt.fone LIKE '%' :chave '%' OR 
                lt.celular LIKE '%' :chave '%' OR 
                lt.primeiro_nome LIKE '%' :chave '%' OR
                lt.ultimo_nome LIKE '%' :chave '%' OR
                lt.cod_barras_leitor LIKE '%' :chave '%'
                ORDER BY leitor_id ASC LIMIT :limit OFFSET :offset", "chave={$this->Dados['chave']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

}
