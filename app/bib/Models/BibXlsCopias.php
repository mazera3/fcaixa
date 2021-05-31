<?php

namespace App\bib\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of BibXlsCopias
 *
 * @copyright (c) year, Édio Mazera
 */
class BibXlsCopias {

    private $DadosXls;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function xls($DadosXls = null) {
        $this->DadosXls = (int) $DadosXls;

        $arquivo = 'Relatorio_copias.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="7">Relatorio - Copias</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<th><b>Id</b></th>';
        $html .= '<th><b>Titulo</b></th>';
        $html .= '<th><b>Subtitulo</b></th>';
        $html .= '<th><b>Autor</b></th>';
        $html .= '<th><b>Editora</b></th>';
        $html .= '<th><b>Cod. Barras</b></th>';
        $html .= '<th><b>Chamada</b></th>';
        $html .= '</tr>';

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

        foreach ($this->Resultado as $c) {
            extract($c);
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
