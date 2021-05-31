<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibXlsLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class BibXlsLeitores {

    private $DadosXls;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function xls($DadosXls = null) {
        $this->DadosXls = (int) $DadosXls;

        $arquivo = 'Relatorio_de_leiores.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="4" style="text-align: center;">Relatorio - Leitores</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th><b>Id</b></th>';
        $html .= '<th><b>Codigo de Barras</b></th>';
        $html .= '<th><b>Nome Completo</b></th>';
        $html .= '<th><b>E-Mail</b></th>';
        $html .= '</tr>';

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
// Configurações header para forçar o download
        header("Expires: Sex, 01 Jan 2021 00:00:00 GMT");
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
