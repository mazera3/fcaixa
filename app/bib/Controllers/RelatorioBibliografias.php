<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of RelatorioBibliografias
 *
 * @copyright (c) year, Édio Mazera
 */
class RelatorioBibliografias {

    private $Dados;
    private $PageId;
    private $DadosPdf;
    private $DadosXls;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'pdf' => ['menu_controller' => 'relatorio-bibliografias', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'relatorio-bibliografias', 'menu_metodo' => 'listar']
        ];
        
        $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\bib\Models\BibPdfBibliografias();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\bib\Models\BibXlsBibliografias();
            $imprime->xls($this->DadosXls);
        }
        
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarBibliografias = new \App\bib\Models\BibRelatorioBibliografias();
        $this->Dados['listBiblio'] = $listarBibliografias->listarBibliografia($this->PageId);
        $this->Dados['qtBiblio'] = $listarBibliografias->qtBiblio();
        $this->Dados['paginacao'] = $listarBibliografias->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/relatorio/relatorioBibliografias", $this->Dados);
        $carregarView->renderizar();
    }

}
