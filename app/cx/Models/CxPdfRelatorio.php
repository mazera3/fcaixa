<?php

namespace App\cx\Models;

use Dompdf\Dompdf;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxPdfRelatorio
 *
 * @copyright (c) year, Édio Mazera
 */
class CxPdfRelatorio
{

    private $DadosPdf;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function pdf($DadosPdf = null, $DadosMes = null, $DadosAno = null)
    {
        $this->DadosPdf = (int) $DadosPdf;
        $this->DadosMes = (int) $DadosMes;
        $this->DadosAno = (int) $DadosAno;

        //Criando a Instancia
        $dompdf = new Dompdf();
        //dados - cabecario
        $html = '<table border=1 style="font-size: 13px;"';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= "<th colspan='2'>Entradas</th>";
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th>Descrição</th>';
        $html .= '<th>Valor (R$)</th>';
        $html .= '</tr>';

        $html .= '</thead>';
        $html .= '<tbody>';

        // Relatório Mensal atual de entrada

        $listarRelatorio = new \App\adms\Models\helper\AdmsRead();
        $listarRelatorio->fullRead("SELECT ent.*, dc.descricao, m.id_mes id_mes_ent, m.extenso mes_ent FROM cx_entrada ent
        INNER JOIN cx_descricao dc ON dc.id_des=ent.descricao_id
        INNER JOIN cx_mes m ON m.mes=ent.mes
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_ent ASC", "ano={$this->DadosAno}&id_mes={$this->DadosMes}");
        $this->Resultado = $listarRelatorio->getResultado();
        $total_entradas = 0;
        foreach ($this->Resultado as $e) {
            extract($e);
            $total_entradas += $valor;
            $html .= '<tr>';
            $html .= "<td>" . $descricao . "</td>";
            $html .= "<td>R$ " . number_format($valor, 2, ',', '.') . "</td>";
            $html .= '</tr>';
        }
        $html .= '<tr>';
        $html .= "<th style='color:#0000ff'>Total de Entradas</th>";
        $html .= "<th style='color:#0000ff'>R$ " . number_format($total_entradas, 2, ',', '.') . "</th>";
        $html .= '</tr>';

        //$html .= '</tbody>';
        //$html .= '</table';

        //$html = '<table border=1 style="font-size: 13px;"';
        //$html .= '<thead>';
        $html .= '<tr>';
        $html .= "<th colspan='2'>Saidas</th>";
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th>Descrição</th>';
        $html .= '<th>Valor (R$)</th>';
        $html .= '</tr>';

        $html .= '</thead>';
        $html .= '<tbody>';
        // Relatório Mensal atual de saida
        $listarRelatorio = new \App\adms\Models\helper\AdmsRead();
        $listarRelatorio->fullRead("SELECT sai.*, dc.descricao, m.id_mes, m.extenso mes_sai FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_mes m ON m.mes=sai.mes
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_sai ASC", "ano={$this->DadosAno}&id_mes={$this->DadosMes}");
        $this->Resultado = $listarRelatorio->getResultado();
        $total_saidas = 0;
        foreach ($this->Resultado as $s) {
            extract($s);
            $total_saidas += $valor;
            $html .= '<tr>';
            $html .= "<td>" . $descricao . "</td>";
            $html .= "<td>R$ " . number_format($valor, 2, ',', '.') . "</td>";
            $html .= '</tr>';
        }
        $html .= '<tr>';
        $html .= "<th style='color:#ff0000'>Total de Saídas</th>";
        $html .= "<th style='color:#ff0000'>R$ " . number_format($total_saidas, 2, ',', '.') . "</th>";
        $html .= '</tr>';
        // Saldo Atual
        $listarSaldo = new \App\adms\Models\helper\AdmsRead();
        $listarSaldo->fullRead("SELECT sal.*, m.id_mes id_mes_atual, m.mes, m.extenso FROM cx_saldo sal
        INNER JOIN cx_mes m ON m.id_mes=sal.mes_id
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_sal ASC", "ano={$this->DadosAno}&id_mes={$this->DadosMes}");
        $this->Resultado = $listarSaldo->getResultado();
        foreach ($this->Resultado as $sa) {
            extract($sa);
            
            $html .= "<tr style='background-color:#cfcfcc;'>";
            $html .= "<th>Saldo</th>";
            $html .= "<th>R$ " . number_format($saldo, 2, ',', '.') . "</th>";
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table';

        // Carrega seu HTML

        $dompdf->loadhtml('
			<h1 style="text-align: center;">Relatório Mensal</h1>
			' . $html . '
		');
        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
            "Relatorio_Mensal.pdf",
            array(
                "Attachment" => true //Para realizar o download somente alterar para true //false
            )
        );
    }
}
