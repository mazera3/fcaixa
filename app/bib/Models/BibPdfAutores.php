<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdfAutores
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfAutores {

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
        $html .= '<th>Autor</th>';
        $html .= '<th>E-Mail</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $listarAutor = new \App\adms\Models\helper\AdmsRead();
        $listarAutor->fullRead("SELECT * FROM bib_autores ORDER BY autor ASC");
        $this->Resultado = $listarAutor->getResultado();

        foreach ($this->Resultado as $a) {
            extract($a);
            $html .= '<tr>';
            $html .= '<td>' . $aut_id . "</td>";
            $html .= '<td>' . $autor . "</td>";
            $html .= '<td>' . $email . "</td>";
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table';
        // Carrega seu HTML

        $dompdf->load_html('
			<h1 style="text-align: center;">Relatório - Autores</h1>
			' . $html . '
		');
        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
                "Relatorio_de_autores.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
