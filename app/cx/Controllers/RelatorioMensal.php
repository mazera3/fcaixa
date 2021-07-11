<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RelatorioMensal
 *
 * @copyright (c) year, Édio Mazera
 */
class RelatorioMensal
{

    private $Dados;

    public function listar()
    {
        $listarSelect = new \App\cx\Models\CxListarRelatorioMensal();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'pdf' => ['menu_controller' => 'relatorio-mensal', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'relatorio-mensal', 'menu_metodo' => 'listar']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosSaldo = filter_input(INPUT_GET, "s", FILTER_SANITIZE_STRING);
        if (!empty($this->DadosMes)) {
            $listarRelatorioMensal = new \App\cx\Models\CxListarRelatorioMensal();
            $this->Dados['listRelEnt'] = $listarRelatorioMensal->listarRelatorioMensalEnt($this->DadosMes,$this->DadosAno);
            $this->Dados['listRelSai'] = $listarRelatorioMensal->listarRelatorioMensalSai($this->DadosMes,$this->DadosAno);
            $this->Dados['listSal'] = $listarRelatorioMensal->listarSaldoAnterior($this->DadosMes,$this->DadosAno);
            $this->Dados['somaEnt'] = $listarRelatorioMensal->somarEntradaMensal($this->DadosMes,$this->DadosAno);
            $this->Dados['somaSai'] = $listarRelatorioMensal->somarSaidaMensal($this->DadosMes,$this->DadosAno);
            $this->Dados['SalMesAntAnt'] = $listarRelatorioMensal->SaldoMesAnteAnterior($this->DadosMes,$this->DadosAno);
            $this->Dados['entMenAnt'] = $listarRelatorioMensal->EntMensalAnterior($this->DadosMes,$this->DadosAno);
            $this->Dados['saiMenAnt'] = $listarRelatorioMensal->SaiMensalAnterior($this->DadosMes,$this->DadosAno);
        } else {
            $listarRelatorioMensal = new \App\cx\Models\CxListarRelatorioMensal();
            $this->Dados['listRelEnt'] = $listarRelatorioMensal->listarRelatorioFullEnt();
            $this->Dados['listRelSai'] = $listarRelatorioMensal->listarRelatorioFullSai();
        }
        if (isset($this->DadosSaldo) AND isset($this->DadosMes) ) {
            $saldoMensal = new \App\cx\Models\CxListarRelatorioMensal();
            $saldoMensal->updateSaldo($this->DadosMes, $this->DadosAno, $this->DadosSaldo);
        }
        
        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarRelatorioMensal();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "relatorio-mensal/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Receber = filter_input(INPUT_GET, "rc", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Receber)) {
            $Receber = new \App\cx\Models\CxListarRelatorioMensal();
            $Receber->receber($this->DadosId, $this->Receber);
            $UrlDestino = URLADM . "relatorio-mensal/listar";
            header("Location: $UrlDestino");
        }
        /* $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\cx\Models\CxPdfRelatorio();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\cx\Models\CxXlsRelatorio();
            $imprime->xls($this->DadosXls);
        } */

        $carregarView = new \App\cx\core\ConfigView("cx/Views/relatorio/relatorioMensal", $this->Dados);
        $carregarView->renderizar();
    }
}
