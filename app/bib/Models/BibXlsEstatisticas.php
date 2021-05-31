<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibXlsEstatisticas
 *
 * @copyright (c) year, Édio Mazera
 */
class BibXlsEstatisticas {

    private $DadosXls;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function xls($DadosXls = null) {
        $this->DadosXls = (int) $DadosXls;
        //Criando a Instancia
        $arquivo = 'Relatorio_estatisticas.xls';
        //$arquivo = 'Relatorio_estatisticas.ods';

// Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= '<table border="1" style="font-size: 13px;">';
        $html .= '<tr>';
        $html .= '<td colspan="2">Relatorio - Estatisticas</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th style="text-align: left">Bibliografias</th>';
        $contarBibliografia = new \App\adms\Models\helper\AdmsRead();
        $contarBibliografia->fullRead("SELECT COUNT(bib_id) AS num_bibliografias FROM bib_biblio");
        $this->Resultado = $contarBibliografia->getResultado();
        foreach ($this->Resultado as $b) {
            extract($b);
            $html .= '<td>' . $num_bibliografias . "</td>";
        }
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th style="text-align: left">Leitores</th>';
        $contarLeitor = new \App\adms\Models\helper\AdmsRead();
        $contarLeitor->fullRead("SELECT COUNT(leitor_id) AS num_leitores FROM bib_leitor");
        $this->Resultado = $contarLeitor->getResultado();
        foreach ($this->Resultado as $l) {
            extract($l);
            $html .= '<td>' . $num_leitores . "</td>";
        }
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th style="text-align: left">Emprestimos</th>';
        $contarEmprestimo = new \App\adms\Models\helper\AdmsRead();
        $contarEmprestimo->fullRead("SELECT COUNT(sit_copia) AS num_emprestimos FROM bib_copia
    WHERE sit_copia = 2");
        $this->Resultado = $contarEmprestimo->getResultado();
        foreach ($this->Resultado as $e) {
            extract($e);
            $html .= '<td>' . $num_emprestimos . "</td>";
        }
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th style="text-align: left">Copias</th>';
        $contarCopias = new \App\adms\Models\helper\AdmsRead();
        $contarCopias->fullRead("SELECT COUNT(cop_id) AS num_copias FROM bib_copia");
        $this->Resultado = $contarCopias->getResultado();
        foreach ($this->Resultado as $c) {
            extract($c);
            $html .= '<td>' . $num_copias . "</td>";
        }
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th style="text-align: left">Atrasos</th>';
        $contarAtrasos = new \App\adms\Models\helper\AdmsRead(); // DATEDIFF (data_final, data_inicial)
        $contarAtrasos->fullRead("SELECT COUNT(cop_id) AS num_atrasos FROM bib_copia WHERE DATEDIFF(data_dev, CURDATE()) < 0");
        $this->Resultado = $contarAtrasos->getResultado();
        foreach ($this->Resultado as $a) {
            extract($a);
            $html .= '<td>' . $num_atrasos . "</td>";
        }
        $html .= '</tr>';

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: array('application/excel', 'application/vnd.ms-excel', 'application/msexcel')");
        //header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        exit;
    }

}
