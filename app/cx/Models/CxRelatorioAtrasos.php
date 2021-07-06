<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxRelatorio
 *
 * @copyright (c) year, Édio Mazera
 */
class CxRelatorioAtrasos {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function contarBibliografia() {
        $contarBibliografia = new \App\adms\Models\helper\AdmsRead();
        $contarBibliografia->fullRead("SELECT COUNT(bib_id) AS num_bibliografias FROM bib_biblio");
        $this->Resultado = $contarBibliografia->getResultado();
        return $this->Resultado;
    }

    public function contarLeitor() {
        $contarLeitor = new \App\adms\Models\helper\AdmsRead();
        $contarLeitor->fullRead("SELECT COUNT(leitor_id) AS num_leitores FROM bib_leitor");
        $this->Resultado = $contarLeitor->getResultado();
        return $this->Resultado;
    }

    public function contarEmprestimo() {
        $contarEmprestimo = new \App\adms\Models\helper\AdmsRead();
        $contarEmprestimo->fullRead("SELECT COUNT(sit_copia) AS num_emprestimos FROM bib_copia
                WHERE sit_copia = 2");
        $this->Resultado = $contarEmprestimo->getResultado();
        return $this->Resultado;
    }

    public function contarCopias() {
        $contarCopias = new \App\adms\Models\helper\AdmsRead();
        $contarCopias->fullRead("SELECT COUNT(cop_id) AS num_copias FROM bib_copia");
        $this->Resultado = $contarCopias->getResultado();
        return $this->Resultado;
    }

    public function contarAtrasos() {
        $contarAtrasos = new \App\adms\Models\helper\AdmsRead(); //  DATEDIFF (data_final, data_inicial)
        $contarAtrasos->fullRead("SELECT COUNT(cop_id) AS num_atrasos FROM bib_copia WHERE DATEDIFF(data_dev, CURDATE()) < 0");
        $this->Resultado = $contarAtrasos->getResultado();
        return $this->Resultado;
    }

    public function listarAtrasos($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'relatorio/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(cop_id) AS num_result FROM bib_copia WHERE DATEDIFF(data_dev, CURDATE()) < 0");
        $this->ResultadoPg = $paginacao->getResultado();

        $contarAtrasos = new \App\adms\Models\helper\AdmsRead();
        $contarAtrasos->fullRead("SELECT cp.*, bib.*, aut.*, lt.*, DATEDIFF(data_dev, CURDATE()) AS dias FROM bib_copia cp
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_leitor lt ON lt.leitor_id=cp.id_leitor
                WHERE DATEDIFF(data_dev, CURDATE()) < 0 
                ORDER BY cop_id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $contarAtrasos->getResultado();
        return $this->Resultado;
    }

}
