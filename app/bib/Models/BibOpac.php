<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibOpac
 *
 * @copyright (c) year, Édio Mazera
 */
class BibOpac {

    private $Dados;
    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5;
    private $ResultadoPg;
    private $PesqBiblio;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function pesquisarBibliografias($PageId = null, $Dados = null) {
        $this->PageId = (int) $PageId;
        $this->Dados = $Dados;
        $this->Dados['titulo'] = trim($this->Dados['titulo']);
        $this->Dados['autor'] = trim($this->Dados['autor']);
        $this->Dados['sub_titulo'] = trim($this->Dados['sub_titulo']);
        $this->Dados['chamada'] = trim($this->Dados['chamada']);
        $this->Dados['chave'] = trim($this->Dados['chave']);

        $_SESSION['pesqBiblioTitulo'] = $this->Dados['titulo'];
        $_SESSION['pesqBiblioAutor'] = $this->Dados['autor'];
        $_SESSION['pesqBiblioSubtitulo'] = $this->Dados['sub_titulo'];
        $_SESSION['pesqBiblioChamada'] = $this->Dados['chamada'];
        $_SESSION['pesqBiblioChave'] = $this->Dados['chave'];

        if (!empty($this->Dados['titulo'])) {
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

    public function pesqBiblio($PesqBiblio = null) {
        $this->PesqBiblio = (string) $PesqBiblio;

        $this->ResultadoPg = null;

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT bib.bib_id, bib.titulo, bib.sub_titulo, bib.ano, bib.topicos, bib.chamada , bib.capa_imagem, sit.nome nome_sit, cr.cor cor_cr, ed.editora, uf.uf, aut.autor
                FROM bib_biblio bib
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_uf uf ON uf.uf_id=ed.id_uf
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                WHERE (bib.titulo LIKE '%' :titulo '%' 
                OR aut.autor LIKE '%' :autor '%' 
                OR bib.sub_titulo LIKE '%' :sub_titulo '%' 
                OR bib.chamada LIKE '%' :chamada '%')
                ORDER BY bib_id ASC LIMIT :limit", "titulo=" . $this->PesqBiblio . "&autor=" . $this->PesqBiblio . "&sub_titulo=" . $this->PesqBiblio . "&chamada=" . $this->PesqBiblio . "&limit={$this->LimiteResultado}");
        $this->Resultado = $listarBiblio->getResultado();

        return $this->Resultado;
    }

    private function pesquisarBiblioTitulo() { // pesquisa somente o titulo
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'opac/listar', '?titulo=' . $this->Dados['titulo']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(bib.bib_id) AS num_result 
                FROM bib_biblio bib
                WHERE bib.titulo LIKE '%' :titulo '%' ", "titulo={$this->Dados['titulo']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT bib.bib_id, bib.titulo, sit.nome nome_sit, cr.cor cor_cr, aut.autor
                FROM bib_biblio bib
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                WHERE (bib.titulo LIKE '%' :titulo '%')
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset",
                "titulo={$this->Dados['titulo']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

    private function pesquisarBiblioAutor() { // pesquisa somente autor
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'opac/listar', '?autor=' . $this->Dados['autor']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(bib.bib_id) AS num_result 
                FROM bib_biblio bib
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                WHERE aut.autor LIKE '%' :autor '%' ", "autor={$this->Dados['autor']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT bib.bib_id, bib.titulo, sit.nome nome_sit, cr.cor cor_cr, aut.autor
                FROM bib_biblio bib
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                WHERE aut.autor LIKE '%' :autor '%' 
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset", "autor={$this->Dados['autor']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

    private function pesquisarBiblioSubtitulo() { // pesquisa somente por sub_titulo
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'opac/listar', '?sub_titulo=' . $this->Dados['sub_titulo']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(bib.bib_id) AS num_result 
                FROM bib_biblio bib
                WHERE sub_titulo LIKE '%' :sub_titulo '%' ", "sub_titulo={$this->Dados['sub_titulo']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT bib.bib_id, bib.titulo, sit.nome nome_sit, cr.cor cor_cr, aut.autor
                FROM bib_biblio bib
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                WHERE bib.sub_titulo LIKE '%' :sub_titulo '%' 
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset", "sub_titulo={$this->Dados['sub_titulo']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

    private function pesquisarBiblioChamada() { // pesquisa somente por chamada
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'opac/listar', '?chamada=' . $this->Dados['chamada']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(bib.bib_id) AS num_result 
                FROM bib_biblio bib
                WHERE chamada LIKE '%' :v '%' ", "chamada={$this->Dados['chamada']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT bib.bib_id, bib.titulo, sit.nome nome_sit, cr.cor cor_cr, aut.autor, bib.chamada
                FROM bib_biblio bib
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                WHERE bib.chamada LIKE '%' :chamada '%' 
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset", "chamada={$this->Dados['chamada']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

    public function pesquisarBiblioChave() { // pesquisa somente por palavra chave
        $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'opac/listar', '?chave=' . $this->Dados['chave']);
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(bib.bib_id) AS num_result
            FROM bib_biblio bib
            INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
            INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                WHERE bib.titulo LIKE '%' :chave '%' OR 
                bib.sub_titulo LIKE '%' :chave '%' OR 
                bib.chamada LIKE '%' :chave '%' OR 
                bib.topicos LIKE '%' :chave '%' OR
                bib.ano LIKE '%' :chave '%' OR
                aut.autor LIKE '%' :chave '%' OR
                ed.editora LIKE '%' :chave '%'
                ", "chave={$this->Dados['chave']}");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarBiblio = new \App\adms\Models\helper\AdmsRead();
        $listarBiblio->fullRead("SELECT bib.bib_id, bib.titulo, bib.sub_titulo, sit.nome nome_sit, cr.cor cor_cr, aut.autor, bib.chamada, bib.topicos, bib.ano, ed.editora
                FROM bib_biblio bib
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_sits_biblio sit ON sit.id=bib.sit_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                WHERE bib.titulo LIKE '%' :chave '%' OR 
                bib.sub_titulo LIKE '%' :chave '%' OR 
                bib.chamada LIKE '%' :chave '%' OR 
                bib.topicos LIKE '%' :chave '%' OR 
                bib.ano LIKE '%' :chave '%' OR 
                aut.autor LIKE '%' :chave '%' OR
                ed.editora LIKE '%' :chave '%'
                ORDER BY bib_id ASC LIMIT :limit OFFSET :offset", "chave={$this->Dados['chave']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarBiblio->getResultado();
    }

}
