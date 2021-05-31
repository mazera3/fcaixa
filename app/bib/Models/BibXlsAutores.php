<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibXlsAutores
 *
 * @copyright (c) year, Édio Mazera
 */
class BibXlsAutores {

    private $DadosXls;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function xls($DadosXls = null) {
        $this->DadosXls = (int) $DadosXls;

        $arquivo = 'Relatorio_autores.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="3">Relatorio - Autores</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th><b>Id</b></th>';
        $html .= '<th><b>Autor</b></th>';
        $html .= '<th><b>E-mail</b></th>';
        $html .= '</tr>';

        $listarAutor = new \App\adms\Models\helper\AdmsRead();
        $listarAutor->fullRead("SELECT * FROM bib_autores ORDER BY autor ASC");
        $this->Resultado = $listarAutor->getResultado();

        foreach ($this->Resultado as $a) {
            extract($a);
            $html .= '<tr>';
            $html .= '<td>' . $aut_id . "</td>";
            $html .= '<td>' . $autor ."</td>";
            $html .= '<td>' . $email . "</td>";
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
