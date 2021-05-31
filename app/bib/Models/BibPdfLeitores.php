<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdfLeitores
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfLeitores {

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
        $html = '<table border=1 style="font-size: 13px;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Id</th>';
        $html .= '<th>Codigo de Barras</th>';
        $html .= '<th>Nome Completo</th>';
        $html .= '<th>E-Mail</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $listarLeitor = new \App\adms\Models\helper\AdmsRead();
        $listarLeitor->fullRead("SELECT lt.* FROM bib_leitor lt
                ORDER BY leitor_id, primeiro_nome, ultimo_nome ASC");
        $this->Resultado = $listarLeitor->getResultado();

        foreach ($this->Resultado as $l) {
            extract($l);
            $html .= '<tr>';
            $html .= '<td>' . $leitor_id . "</td>";
            $html .= '<td>' . $cod_barras_leitor . "</td>";
            $html .= '<td>' . $primeiro_nome . ' - ' . $ultimo_nome . "</td>";
            $html .= '<td>' . $email . "</td>";
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        // Carrega seu HTML

        $dompdf->load_html('
			<h1 style="text-align: center;">Relatório - Leitores</h1>
			' . $html . '
		');
        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
                "Relatorio_de_leitores.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
