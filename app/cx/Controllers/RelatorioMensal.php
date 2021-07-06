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

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarRelatorioMensal = new \App\cx\Models\CxListarRelatorioMensal();
            $this->Dados['listRelEnt'] = $listarRelatorioMensal->listarRelatorioMensalEnt($this->DadosMes);
            $this->Dados['listRelSai'] = $listarRelatorioMensal->listarRelatorioMensalSai($this->DadosMes);
        } else {
            $listarRelatorioMensal = new \App\cx\Models\CxListarRelatorioMensal();
            $this->Dados['listRelEnt'] = $listarRelatorioMensal->listarRelatorioFullEnt();
            $this->Dados['listRelSai'] = $listarRelatorioMensal->listarRelatorioFullSai();
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
