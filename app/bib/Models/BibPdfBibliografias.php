<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdfBibliografias
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfBibliografias {

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
        $html .= '<th>Chamada</th>';
        $html .= '<th>ISBN</th>';
        $html .= '<th>Titulo / Subtítulo</th>';
        $html .= '<th>Autor / Editora</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $listarBibliografia = new \App\adms\Models\helper\AdmsRead();
        $listarBibliografia->fullRead("SELECT bib.*, ed.editora, uf.uf, aut.autor
                FROM bib_biblio bib
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_uf uf ON uf.uf_id=ed.id_uf
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                ORDER BY bib_id ASC");
        $this->Resultado = $listarBibliografia->getResultado();

        foreach ($this->Resultado as $d) {
            extract($d);
            $html .= '<tr>';
            $html .= '<td>' . $bib_id . "</td>";
            $html .= '<td>' . $chamada . "</td>";
            $html .= '<td>' . $isbn . "</td>";
            $html .= '<td>' . $titulo . ' - ' . $sub_titulo . "</td>";
            $html .= '<td>' . $autor . ' - ' . $editora . "</td>";
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table';
        // Carrega seu HTML

        $dompdf->load_html('
			<h1 style="text-align: center;">Relatório - Bibliografias</h1>
			' . $html . '
		');
        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
                "Relatorio_de_bibliografias.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
