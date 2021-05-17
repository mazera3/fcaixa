<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibRetirarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class BibRetirarCopia {

    private $Resultado;
    private $CopiaId;
    private $LeitorId;
    private $LimiteResultado = 10;
    private $ResultadoPg;
    private $Dados;
    private $DadosH;
    private $PageId;
    private $DadosForm;
    private $DiasRet;

    function getResultado() {
        return $this->Resultado;
    }

    public function retCopia($CopiaId = null, $LeitorId = null, $DiasRet = null, $Dados = null, $PageId = null) {
        $this->CopiaId = (int) $CopiaId;
        $this->LeitorId = (int) $LeitorId;
        $this->DiasRet = (int) $DiasRet;
        $this->Dados = (int) $Dados;
        $this->PageId = (int) $PageId;

        $this->verCopia();
        if ($this->Dados) {
            $this->altCopia();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível retirar a cópia!</div>";
            $this->Resultado = false;
        }
    }

    private function verCopia() {
        $verCopia = new \App\adms\Models\helper\AdmsRead();
        $verCopia->fullRead("SELECT cp.* FROM bib_copia cp
                WHERE cp.cop_id =:cop_id", "cop_id={$this->CopiaId}");
        $this->Dados = $verCopia->getResultado();
    }

    private function altCopia() {
        if ($this->Dados[0]['sit_copia'] == 1) {
            $this->Dados[0]['sit_copia'] = 2;
            $this->Dados[0]['id_leitor'] = $this->LeitorId;
            $this->Dados[0]['data_emp'] = date("Y-m-d");
            $this->Dados[0]['data_dev'] = date("Y-m-d", strtotime("+" . $this->DiasRet . "days"));

            $this->Dados[0]['sit_res'] = 1;
            $this->Dados[0]['id_res'] = null;
            $this->Dados[0]['data_res'] = null;
            $this->Dados[0]['data_lib'] = null;

            $this->Dados[0]['modified'] = date("Y-m-d H:i:s");
            $this->upCopia();
        } elseif ($this->Dados[0]['sit_copia'] == 2 AND $this->Dados[0]['id_leitor'] == $this->LeitorId) {
            $this->Dados[0]['sit_copia'] = 1;
            $this->Dados[0]['id_leitor'] = null;
            $this->Dados[0]['data_emp'] = null;
            $this->Dados[0]['data_dev'] = null;
            $this->Dados[0]['modified'] = date("Y-m-d H:i:s");
            $this->upCopia();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Esta cópia encontra-se emprestada!</div>";
            $this->Resultado = false;
        }
    }

    public function pesquisarCopias($PageId = null, $DadosForm = null) {
        $this->PageId = (int) $PageId;
        $this->DadosForm = $DadosForm;
        $this->DadosForm['cod_bar'] = trim($this->DadosForm['cod_bar']);
        $_SESSION['pesqBiblioCodBar'] = $this->DadosForm['cod_bar'];

        if (!empty($this->DadosForm['cod_bar'])) {
            $paginacao = new \App\bib\Models\helper\BibPaginacao(URLADM . 'ver-leitor/ver-leitor/' . $this->LeitorId, '?cod_bar=' . $this->DadosForm['cod_bar']);
            $paginacao->condicao($this->PageId, $this->LimiteResultado);
            $paginacao->paginacao("SELECT COUNT(cop_id) AS num_result FROM bib_copia
                WHERE cod_bar LIKE '%' :cod_bar '%' ", "cod_bar={$this->DadosForm['cod_bar']}");
            $this->ResultadoPg = $paginacao->getResultado();

            $pesqBiblio = new \App\adms\Models\helper\AdmsRead();
            $pesqBiblio->fullRead("SELECT cp.*, bib.titulo, bib.colecao_id, col.dias_retorno, stc.nome nome_stc, cr.cor cor_cr
                FROM bib_copia cp
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_colecao col ON col.col_id=bib.colecao_id
                INNER JOIN bib_sits_copia stc ON stc.id=cp.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                WHERE cp.cod_bar LIKE '%' :cod_bar '%' 
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "cod_bar={$this->DadosForm['cod_bar']}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
            $this->Resultado = $pesqBiblio->getResultado();
        } return $this->Resultado;
    }

    public function listarEmp($LeitorId = null) {
        $this->LeitorId = $LeitorId;
        $listarCopia = new \App\adms\Models\helper\AdmsRead();
        $listarCopia->fullRead("SELECT cp.*, bib.*, stc.nome nome_stc, cr.cor cor_cr, aut.autor, ed.editora, bib.opac_flag
                FROM bib_copia cp 
                INNER JOIN bib_sits_copia stc ON stc.id=cp.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                WHERE (cp.id_leitor =:id_leitor OR
                cp.id_res =:id_leitor)
                ORDER BY cop_id ASC", "id_leitor={$this->LeitorId}");
        $this->Resultado = $listarCopia->getResultado();
        return $this->Resultado;
    }

    private function upCopia() {
        $upCopia = new \App\adms\Models\helper\AdmsUpdate();
        $upCopia->exeUpdate("bib_copia", $this->Dados[0], "WHERE cop_id =:cop_id", "cop_id={$this->CopiaId}");

        $c = $this->Dados[0]['cod_bar'];
        if ($upCopia->getResultado() AND $this->Dados[0]['sit_copia'] == 2) {
            $_SESSION['msg'] = "<div class='alert alert-success'>A Cópia $c foi retirada com sucesso para o leitor $this->LeitorId!</div>";
            $this->inserirHistorico();
            $this->Resultado = true;
        } elseif ($upCopia->getResultado() AND $this->Dados[0]['sit_copia'] == 1) {
            $_SESSION['msg'] = "<div class='alert alert-info'>A Cópia $c foi devolvida com sucesso pelo leitor $this->LeitorId!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível retira a cópia!</div>";
            $this->Resultado = false;
        }
    }

    private function inserirHistorico() {
        $this->DadosH['created'] = date("Y-m-d H:i:s");
        $this->DadosH['id_lt'] = $this->LeitorId;
        $this->DadosH['cp_id'] = $this->CopiaId;

        $cadHist = new \App\adms\Models\helper\AdmsCreate;
        $cadHist->exeCreate("bib_historico", $this->DadosH);
        /*
          if ($cadHist->getResultado()) {
          $_SESSION['msg'] = "<div class='alert alert-success'>Histórico cadastrado com sucesso!</div>";
          $this->Resultado = true;
          } else {
          $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: o Histórico não foi cadastrado!!</div>";
          $this->Resultado = false;
          }
         * */
    }
    
    public function listarHist($LeitorId = null) {
        $this->LeitorId = $LeitorId;
        $listarHist = new \App\adms\Models\helper\AdmsRead();
        $listarHist->fullRead("SELECT his.*, cp.*, bib.* FROM bib_historico his 
                INNER JOIN bib_copia cp ON cp.cop_id=his.cp_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                WHERE his.id_lt =:id_lt
                ORDER BY id_hist ASC", "id_lt={$this->LeitorId}");
        $this->Resultado = $listarHist->getResultado();
        return $this->Resultado;
    }

}
