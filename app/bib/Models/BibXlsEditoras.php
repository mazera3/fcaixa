<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibXlsEditoras
 *
 * @copyright (c) year, Édio Mazera
 */
class BibXlsEditoras {

    private $DadosXls;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function xls($DadosXls = null) {
        $this->DadosXls = (int) $DadosXls;

        $arquivo = 'Relatorio_editoras.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="3">Relatorio - Editoras</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th><b>Id</b></th>';
        $html .= '<th><b>Editora</b></th>';
        $html .= '<th><b>Endereco</b></th>';
        $html .= '</tr>';

        $listarEditora = new \App\adms\Models\helper\AdmsRead();
        $listarEditora->fullRead("SELECT ed.*, es.uf, es.nome nome_uf, p.nome_pais, p.sigla FROM bib_editora ed
                INNER JOIN bib_uf es ON es.uf_id=ed.id_uf
                INNER JOIN bib_pais p ON p.pais_id=ed.id_pais
                ORDER BY editora ASC");
        $this->Resultado = $listarEditora->getResultado();

        foreach ($this->Resultado as $a) {
            extract($a);
            $html .= '<tr>';
            $html .= '<td>' . $ed_id . "</td>";
            $html .= '<td>' . $editora ."</td>";
            $html .= '<td>' . $nome_uf . '(' . $uf . ') - ' . $nome_pais . '(' . $sigla . ')' . "</td>";
            $html .= '</tr>';
        }
// Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        header('Content-Encoding: UTF-8');
        // Envia o conteúdo do arquivo
        echo $html;
        exit;
    }

}
