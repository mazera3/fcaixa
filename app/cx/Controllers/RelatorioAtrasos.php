<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Relatorio
 *
 * @copyright (c) year, Édio Mazera
 */
class RelatorioAtrasos {

    private $Dados;
    private $DadosAviso;
    private $PageId;
    private $DadosPdf;
    private $DadosXls;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'pdf' => ['menu_controller' => 'relatorio-atrasos', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'relatorio-atrasos', 'menu_metodo' => 'listar'],
            'aviso' => ['menu_controller' => 'relatorio-atrasos', 'menu_metodo' => 'listar']
        ];
        
        $this->DadosAviso = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosAviso['Aviso'])) {
            unset($this->DadosAviso['Aviso']);
            //var_dump($this->DadosAviso['aviso']);
            $aviso = new \App\cx\Models\CxAviso();
            $aviso->geraAviso($this->DadosAviso);
        }
        
        $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\cx\Models\CxPdfAtrasos();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\cx\Models\CxXlsAtrasos();
            $imprime->xls($this->DadosXls);
        }

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarRelatorio = new \App\cx\Models\CxRelatorioAtrasos();
        $this->Dados['listAtrasos'] = $listarRelatorio->listarAtrasos($this->PageId);
        $this->Dados['paginacao'] = $listarRelatorio->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/relatorio/relatorioAtrasos", $this->Dados);
        $carregarView->renderizar();
    }

}
