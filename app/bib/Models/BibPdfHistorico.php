<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibImprimirHistorico
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfHistorico {

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
        $html .= '<th>Retirada</th>';
        $html .= '<th>Leitor</th>';
        $html .= '<th>Codigo</th>';
        $html .= '<th>Titulo</th>';
        $html .= '<th>Autor</th>';
        $html .= '<th>Editora</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $contarAtrasos = new \App\adms\Models\helper\AdmsRead();
        $contarAtrasos->fullRead("SELECT his.created criado, his.*, cp.*, bib.*, lt.*, au.*, ed.* FROM bib_historico his 
                INNER JOIN bib_copia cp ON cp.cop_id=his.cp_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cp.cop_bib_id
                INNER JOIN bib_autores au ON au.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                INNER JOIN bib_leitor lt ON lt.leitor_id=his.id_lt
                ORDER BY id_hist ASC");
        $this->Resultado = $contarAtrasos->getResultado();

        foreach ($this->Resultado as $d) {
            extract($d);
            $html .= '<tr>';
            $html .= '<td>' . $criado . "</td>";
            $html .= '<td>' . $primeiro_nome . ' ' . $ultimo_nome . "</td>";
            $html .= '<td>' . $cod_bar . "</td>";
            $html .= '<td>' . $titulo . "</td>";
            $html .= '<td>' . $autor . "</td>";
            $html .= '<td>' . $editora . "</td>";
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table';
        // Carrega seu HTML

        $dompdf->load_html('
			<h1 style="text-align: center;">Relatório - Histórico de Retiradas</h1>
			' . $html . '
		');
        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
                "Relatorio_historico_de_retiradas.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
