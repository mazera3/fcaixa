<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPesquisarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPesquisarCopia {

    private $Dados;
    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function pesquisarCopias($PageId = null, $Dados = null) {
        $this->PageId = (int) $PageId;
        $this->Dados = $Dados;
        $this->Dados['cod_bar'] = trim($this->Dados['cod_bar']);
        $this->Dados['titulo'] = trim($this->Dados['titulo']);
        $this->Dados['autor'] = trim($this->Dados['autor']);
        $this->Dados['sub_titulo'] = trim($this->Dados['sub_titulo']);
        $this->Dados['chamada'] = trim($this->Dados['chamada']);
        $this->Dados['chave'] = trim($this->Dados['chave']);

        $_SESSION['pesqBiblioCodBar'] = $this->Dados['cod_bar'];
        $_SESSION['pesqBiblioTitulo'] = $this->Dados['titulo'];
        $_SESSION['pesqBiblioAutor'] = $this->Dados['autor'];
        $_SESSION['pesqBiblioSubtitulo'] = $this->Dados['sub_titulo'];
        $_SESSION['pesqBiblioChamada'] = $this->Dados['chamada'];
        $_SESSION['pesqBiblioChave'] = $this->Dados['chave'];

        if (!empty($this->Dados['cod_bar'])) {
            $this->pesquisarBiblioCodBar();
        } elseif (!empty($this->Dados['titulo'])) {
            $this->pesquisarBiblioTitulo();
        } elseif (!empty($this->Dados['autor'])) {
            $this->pesquisarBiblioAutor();
        } elseif (!empty($this->Dados['sub_titulo'])) {
            $this->pesquisarBiblioSubtitulo();
        } elseif (!empty($this->Dados['chamada'])) {
            $this->pesquisarBiblioChamada();
        } elseif (!empty($this->Dados['chave'])) {
            $this->pesquisarBiblioChave();
        } return $this->Resultado;
    }

    public function listarCopia($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop_id) AS num_result FROM bib_copia");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarCopia = new \App\adms\Models\helper\AdmsRead();
        $listarCopia->fullRead("SELECT cop.*, bib.titulo, bib.sub_titulo, stc.nome nome_stc, cr.cor cor_cr, aut.autor, ed.editora, bib.opac_flag
                FROM bib_copia cop 
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarCopia->getResultado();
        return $this->Resultado;
    }

    // pesquisa somente por código de barras
    private function pesquisarBiblioCodBar() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar', '?cod_bar=' . $this->Dados['cod_bar']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop_id) AS num_result FROM bib_copia
                WHERE cod_bar LIKE '%' :cod_bar '%' ", "cod_bar={$this->Dados['cod_bar']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT cop.*, bib.titulo, bib.sub_titulo, stc.nome nome_stc, cr.cor cor_cr, aut.autor, bib.chamada, ed.editora
                FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE cop.cod_bar LIKE '%' :cod_bar '%' 
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "cod_bar={$this->Dados['cod_bar']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

// pesquisa somente o titulo
    private function pesquisarBiblioTitulo() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar', '?titulo=' . $this->Dados['titulo']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop.cop_id) AS num_result FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                WHERE titulo LIKE '%' :titulo '%' ", "titulo={$this->Dados['titulo']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT cop.*, bib.titulo, bib.sub_titulo, stc.nome nome_stc, cr.cor cor_cr, aut.autor, bib.chamada, ed.editora
                FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE bib.titulo LIKE '%' :titulo '%' 
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "titulo={$this->Dados['titulo']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

// pesquisa somente autor
    private function pesquisarBiblioAutor() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar', '?autor=' . $this->Dados['autor']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop.cop_id) AS num_result FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                WHERE autor LIKE '%' :autor '%' ", "autor={$this->Dados['autor']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT cop.*, bib.titulo, bib.sub_titulo, stc.nome nome_stc, cr.cor cor_cr, aut.autor, bib.chamada, ed.editora
                FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE aut.autor LIKE '%' :autor '%' 
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "autor={$this->Dados['autor']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

// pesquisa somente por sub_titulo
    private function pesquisarBiblioSubtitulo() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar', '?sub_titulo=' . $this->Dados['sub_titulo']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop.cop_id) AS num_result FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                WHERE sub_titulo LIKE '%' :sub_titulo '%' ", "sub_titulo={$this->Dados['sub_titulo']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT cop.*, bib.titulo, bib.sub_titulo, stc.nome nome_stc, cr.cor cor_cr, aut.autor, bib.chamada, ed.editora
                FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE bib.sub_titulo LIKE '%' :sub_titulo '%' 
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "sub_titulo={$this->Dados['sub_titulo']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

// pesquisa somente por chamada
    private function pesquisarBiblioChamada() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar', '?chamada=' . $this->Dados['chamada']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop.cop_id) AS num_result FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                WHERE chamada LIKE '%' :chamada '%' ", "chamada={$this->Dados['chamada']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT cop.*, bib.titulo, bib.sub_titulo, stc.nome nome_stc, cr.cor cor_cr, aut.autor, bib.chamada, ed.editora
                FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE bib.chamada LIKE '%' :chamada '%' 
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "chamada={$this->Dados['chamada']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

// pesquisa por palavra chave
    public function pesquisarBiblioChave() {
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'copias/listar', '?chave=' . $this->Dados['chave']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop.cop_id) AS num_result
            FROM bib_copia cop
            INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
            INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
            INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                WHERE bib.titulo LIKE '%' :chave '%' OR 
                bib.sub_titulo LIKE '%' :chave '%' OR 
                cop.cod_bar LIKE '%' :chave '%' OR 
                bib.chamada LIKE '%' :chave '%' OR 
                bib.topicos LIKE '%' :chave '%' OR
                bib.ano LIKE '%' :chave '%' OR
                aut.autor LIKE '%' :chave '%' OR
                ed.editora LIKE '%' :chave '%'
                ", "chave={$this->Dados['chave']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT cop.*, bib.titulo, bib.sub_titulo, bib.ano, bib.topicos, stc.nome nome_stc, cr.cor cor_cr, aut.autor, bib.chamada, ed.editora
                FROM bib_copia cop
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE bib.titulo LIKE '%' :chave '%' OR 
                bib.sub_titulo LIKE '%' :chave '%' OR 
                cop.cod_bar LIKE '%' :chave '%' OR
                bib.chamada LIKE '%' :chave '%' OR 
                bib.topicos LIKE '%' :chave '%' OR 
                bib.ano LIKE '%' :chave '%' OR 
                aut.autor LIKE '%' :chave '%' OR
                ed.editora LIKE '%' :chave '%'
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset", "chave={$this->Dados['chave']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

}
