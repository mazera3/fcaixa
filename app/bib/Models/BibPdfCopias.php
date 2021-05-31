<?php

namespace App\bib\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibPdfCopias
 *
 * @copyright (c) year, Édio Mazera
 */
class BibPdfCopias {

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
        $html .= '<th>Titulo</th>';
        $html .= '<th>Subtitulo</th>';
        $html .= '<th>Autor</th>';
        $html .= '<th>Editora</th>';
        $html .= '<th>Cod. Barras</th>';
        $html .= '<th>Chamada</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $listarCopia = new \App\adms\Models\helper\AdmsRead();
        $listarCopia->fullRead("SELECT cop.*, bib.*, stc.nome nome_stc, cr.cor cor_cr, aut.autor, ed.editora, bib.opac_flag
                FROM bib_copia cop 
                INNER JOIN bib_sits_copia stc ON stc.id=cop.sit_copia
                INNER JOIN adms_cors cr ON cr.id=stc.adms_cor_id
                INNER JOIN bib_biblio bib ON bib.bib_id=cop.cop_bib_id
                INNER JOIN bib_autores aut ON aut.aut_id=bib.autor_id
                INNER JOIN bib_editora ed ON ed.ed_id=bib.editora_id
                ORDER BY cop_id ASC");
        $this->Resultado = $listarCopia->getResultado();

        foreach ($this->Resultado as $a) {
            extract($a);
            $html .= '<tr>';
            $html .= '<td>' . $cop_id . "</td>";
            $html .= '<td>' . $titulo ."</td>";
            $html .= '<td>' . $sub_titulo ."</td>";
            $html .= '<td>' . $autor . "</td>";
            $html .= '<td>' . $editora . "</td>";
            $html .= '<td>' . $cod_bar . "</td>";
            $html .= '<td>' . $chamada . "</td>";
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table';
// Carrega seu HTML

        $dompdf->load_html('
<h1 style="text-align: center;">Relatório - Copias</h1>
' . $html . '
');
//Renderizar o html
        $dompdf->render();

//Exibibir a página
        $dompdf->stream(
                "Relatorio_de_copias.pdf",
                array(
                    "Attachment" => true //Para realizar o download somente alterar para true //false
                )
        );
    }

}
