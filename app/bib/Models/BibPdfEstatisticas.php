<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdfEstatisticas
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfEstatisticas {

    private $DadosPdf;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function pdf($DadosPdf = null) {
        $this->DadosPdf = (int) $DadosPdf;
        //Criando a Instancia
        $dompdf = new Dompdf();

        $html = '<table border=1 style="font-size: 13px;">';

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
        $html .= '</table>';

// Carrega seu HTML

        $dompdf->load_html('
<h1 style="text-align: center;">Relatório - Estatisticas</h1>
' . $html . '
');
//Renderizar o html
        $dompdf->render();

//Exibibir a página
        $dompdf->stream(
                "Relatorio_estatisticas.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
