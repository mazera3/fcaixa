<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibXlsAtrasos
 *
 * @copyright (c) year, Édio Mazera
 */
class BibXlsAtrasos {

    private $DadosXls;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function xls($DadosXls = null) {
        $this->DadosXls = (int) $DadosXls;

        $arquivo = 'Relatorio_atrasos.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="7">Relatorio - Atrasos</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th><b>Id</b></th>';
        $html .= '<th><b>Codigo</b></th>';
        $html .= '<th><b>Titulo</b></th>';
        $html .= '<th><b>Autor</b></th>';
        $html .= '<th><b>Leitor</b></th>';
        $html .= '<th><b>Previsao de Devolucao</b></th>';
        $html .= '<th><b>Dias em Atraso</b></th>';
        $html .= '</tr>';

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
