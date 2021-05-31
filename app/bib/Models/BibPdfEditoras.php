<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdfEditoras
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfEditoras {

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
        $html .= '<th>Editora</th>';
        $html .= '<th>Endereco</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $listarEditora = new \App\adms\Models\helper\AdmsRead();
        $listarEditora->fullRead("SELECT ed.*, es.uf, es.nome nome_uf, p.nome_pais, p.sigla FROM bib_editora ed
                INNER JOIN bib_uf es ON es.uf_id=ed.id_uf
                INNER JOIN bib_pais p ON p.pais_id=ed.id_pais
                ORDER BY ed_id, editora ASC");
        $this->Resultado = $listarEditora->getResultado();

        foreach ($this->Resultado as $a) {
            extract($a);
            $html .= '<tr>';
            $html .= '<td>' . $ed_id . "</td>";
            $html .= '<td>' . $editora . "</td>";
            $html .= '<td>' . $nome_uf . '(' . $uf . ') - ' . $nome_pais . '(' . $sigla . ')' . "</td>";
            $html .= '</td>';
        }

        $html .= '</tbody>';
        $html .= '</table';
// Carrega seu HTML

        $dompdf->load_html('
<h1 style="text-align: center;">Relatório - Editoras</h1>
' . $html . '
');
//Renderizar o html
        $dompdf->render();

//Exibibir a página
        $dompdf->stream(
                "Relatorio_de_editoras.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
