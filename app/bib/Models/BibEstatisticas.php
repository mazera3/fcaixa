<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibEstatistica
 *
 * @copyright (c) year, Édio Mazera
 */
class BibEstatisticas {

    private $Resultado;

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
        $contarAtrasos = new \App\adms\Models\helper\AdmsRead(); // DATEDIFF (data_final, data_inicial)
        $contarAtrasos->fullRead("SELECT COUNT(cop_id) AS num_atrasos FROM bib_copia WHERE DATEDIFF(data_dev, CURDATE()) < 0");
        $this->Resultado = $contarAtrasos->getResultado();
        return $this->Resultado;
    }
}