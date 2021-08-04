<?php

namespace App\cx\Models;

use Dompdf\Dompdf;
use Dompdf\Options;

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

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);

        //dados - cabecario
        $html = '';
        
        // tabela - entradas 
        $html .= "<div style='float:left;'>";
        $html .= "<table border='0.1' width='50%' style='font-size: 12px;'>";
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= "<th colspan='2' style='background-color:#acffac;'>ENTRADAS</th>";
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= "<th>Descrição</th>";
        $html .= '<th>Valor (R$)</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        // Relatório Mensal atual de entrada

        $listarRelatorio = new \App\adms\Models\helper\AdmsRead();
        $listarRelatorio->fullRead("SELECT ent.*, dc.descricao, m.id_mes id_mes_ent, m.extenso mes_ent FROM cx_entrada ent
        INNER JOIN cx_descricao dc ON dc.id_des=ent.descricao_id
        INNER JOIN cx_mes m ON m.id_mes=ent.mes_id
        WHERE id_mes=:id_mes AND ano=:ano AND situacao=:situacao
        ORDER BY id_ent ASC", "ano={$this->DadosAno}&id_mes={$this->DadosMes}&situacao=1");
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
        $listarRelatorio = new \App\adms\Models\helper\AdmsRead();
        $listarRelatorio->fullRead("SELECT COUNT(valor) AS qte FROM cx_entrada ent
        INNER JOIN cx_mes m ON m.id_mes=ent.mes_id
        WHERE id_mes=:id_mes AND ano=:ano", "ano={$this->DadosAno}&id_mes={$this->DadosMes}");
        $this->Resultado = $listarRelatorio->getResultado();
        foreach ($this->Resultado as $qe) {
            extract($qe);
            $qte;
        }
        $listarRelatorio = new \App\adms\Models\helper\AdmsRead();
        $listarRelatorio->fullRead("SELECT COUNT(valor) AS qts FROM cx_saida sai
        INNER JOIN cx_mes m ON m.id_mes=sai.mes_id
        WHERE id_mes=:id_mes AND ano=:ano", "ano={$this->DadosAno}&id_mes={$this->DadosMes}");
        $this->Resultado = $listarRelatorio->getResultado();
        foreach ($this->Resultado as $qs) {
            extract($qs);
            $qts;
        }
        $n = $qts - $qte;
        for($i=1;$i<$n;$i++){
            $html .= '<tr>';
            $html .= "<td>&nbsp;</td>";
            $html .= "<td>&nbsp;</td>";
            $html .= '</tr>';
        }
        // saldo anterior
        if($this->DadosMes == 1){
            $mes_ant = 12;
            $ano = $this->DadosAno - 1;
        }else{
            $mes_ant = $this->DadosMes - 1;
            $ano = $this->DadosAno;
        }
        
        $listarSaldo = new \App\adms\Models\helper\AdmsRead();
        $listarSaldo->fullRead("SELECT sal.* FROM cx_saldo sal
        INNER JOIN cx_mes m ON m.id_mes=sal.mes_id
        WHERE id_mes=:id_mes AND ano=:ano LIMIT :limit", "limit=1&ano={$ano}&id_mes={$mes_ant}
        ");
        $this->Resultado = $listarSaldo->getResultado();
        foreach ($this->Resultado as $sd) {
            extract($sd);
        }
        $html .= "<tr>";
        $html .= "<th>Saldo Anterior</th>";
        $html .= "<th>R$ " . number_format($saldo, 2, ',', '.') . "</th>";
        $html .= '</tr>';
        //
        $html .= "<tr>";
        $html .= "<th>Total de Entradas</th>";
        $html .= "<th>R$ " . number_format($total_entradas, 2, ',', '.') . "</th>";
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
        $html .= '</table>';
        $html .= "</div>"; // coluna da esquerda

        // tabela - saidas
        $html .= "<div style='float:left;'>";
        $html .= "<table border='0.1' width='50%' style='font-size: 12px;'>";
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= "<th colspan='2' style='background-color:#acffac;'>SAÍDAS</th>";
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
        INNER JOIN cx_mes m ON m.id_mes=sai.mes_id
        WHERE id_mes=:id_mes AND ano=:ano AND situacao=:situacao
        ORDER BY id_sai ASC", "ano={$this->DadosAno}&id_mes={$this->DadosMes}&situacao=1");
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
        $html .= "<tr>";
        $html .= "<th>Total de Saídas</th>";
        $html .= "<th>R$ " . number_format($total_saidas, 2, ',', '.') . "</th>";
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table';
        $html .= "</div>"; // coluna da direita


        // Carrega seu HTML

        $dompdf->loadhtml('<h1 style="text-align: center;">Relatório Mensal - ' . $extenso . '/'.$ano.'</h1>' . $html . '
		');
        //Renderizar o html
        $dompdf->render();

        //Exibibir a página
        $dompdf->stream(
            "Relatorio_Mensal_".$mes."_".$ano.".pdf",
            array(
                "Attachment" => true //Para realizar o download somente alterar para true //false
            )
        );
    }
}
