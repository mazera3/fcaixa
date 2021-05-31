<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibXlsBibliografias
 *
 * @copyright (c) year, Édio Mazera
 */
class BibXlsBibliografias {

    private $DadosXls;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function xls($DadosXls = null) {
        $this->DadosXls = (int) $DadosXls;

        $arquivo = 'Relatorio_de_bibliografias.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="5" style="text-align: center;">Relatorio - Bibliografias</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th><b>Id</b></th>';
        $html .= '<th><b>Chamada</b></th>';
        $html .= '<th><b>ISBN</b></th>';
        $html .= '<th><b>Titulo / Subtitulo</b></th>';
        $html .= '<th><b>Autor / Editora</b></th>';
        $html .= '</tr>';

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
            $html .= '<td>' . $bib_id . "</td>";
            $html .= '<td>' . $chamada . "</td>";
            $html .= '<td>' . $isbn . "</td>";
            $html .= '<td>' . $titulo . ' - ' . $sub_titulo . "</td>";
            $html .= '<td>' . $autor . ' - ' . $editora . "</td>";
            $html .= '</tr>';
        }
// Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: array('application/excel', 'application/vnd.ms-excel', 'application/msexcel')");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        exit;
    }

}
