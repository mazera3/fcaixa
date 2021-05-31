<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RelatorioHistorico
 *
 * @copyright (c) year, Édio Mazera
 */
class RelatorioHistorico {

    private $Dados;
    private $PageId;
    private $DadosPdf;
    private $DadosXls;

    public function listar($PageId = null) {

        //$this->DadosId = (int) $DadosId;
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'pdf' => ['menu_controller' => 'relatorio-historico', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'relatorio-historico', 'menu_metodo' => 'listar']
        ];

        $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\bib\Models\BibPdfHistorico();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\bib\Models\BibXlsHistorico();
            $imprime->xls($this->DadosXls);
        }

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarHistorico = new \App\bib\Models\BibRelatorioHistorico();
        $this->Dados['listHistorico'] = $listarHistorico->listarHistorico($this->PageId);
        $this->Dados['paginacao'] = $listarHistorico->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/relatorio/relatorioHistorico", $this->Dados);
        $carregarView->renderizar();
    }

}
