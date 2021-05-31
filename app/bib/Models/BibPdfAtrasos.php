<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdfAtrasos
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfAtrasos {

    private $DadosPdf;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function pdf($DadosPdf = null) {
        $this->DadosPdf = (int) $DadosPdf;
        //Criando a Instancia
        $dompdf = new Dompdf();
        //dados - cabecario
        $html = '<table border=1 style="font-size: 13px;"';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Id</th>';
        $html .= '<th>Codigo</th>';
        $html .= '<th>Titulo</th>';
        $html .= '<th>Autor</th>';
        $html .= '<th>Leitor</th>';
        $html .= '<th>Previsão de Devolução</th>';
        $html .= '<th>Dias em Atraso</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $contarAtrasos = new \App\adms\Models\helper\AdmsRead();
        $contarAtrasos->fullRead("SELECT cp.*, bib.*, aut.*, lt.*, DATEDIFF(data_dev, CURDATE()) AS dias FROM bib_copia cp
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_leitor lt ON lt.leitor_id=cp.id_leitor
                WHERE DATEDIFF(data_dev, CURDATE()) < 0 
                ORDER BY cop_id ASC");
        $this->Resultado = $contarAtrasos->getResultado();

        foreach ($this->Resultado as $d) {
            extract($d);
            $html .= '<tr>';
            $html .= '<td>' . $cop_id . "</td>";
            $html .= '<td>' . $cod_bar . "</td>";
            $html .= '<td>' . $titulo . "</td>";
            $html .= '<td>' . $autor . "</td>";
            $html .= '<td>' . $primeiro_nome . ' ' . $ultimo_nome . "</td>";
            $html .= '<td>' . $data_dev . "</td>";
            $html .= '<td>' . abs($dias) . "</td>";
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table';
        // Carrega seu HTML

        $dompdf->load_html('
			<h1 style="text-align: center;">Relatório - Atrasos</h1>
			' . $html . '
		');
        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
                "Relatorio_atrasos.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
