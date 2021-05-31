<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Estatisticas
 *
 * @copyright (c) year, Édio Mazera
 */
class Estatisticas {

    private $Dados;
    private $PageId;
    private $DadosPdf;
    private $DadosXls;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'pdf' => ['menu_controller' => 'estatisticas', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'estatisticas', 'menu_metodo' => 'listar']
        ];
        $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\bib\Models\BibPdfEstatisticas();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\bib\Models\BibXlsEstatisticas();
            $imprime->xls($this->DadosXls);
        }
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $contarLeitores = new \App\bib\Models\BibEstatisticas();
        $this->Dados['contarLeitor'] = $contarLeitores->contarLeitor();

        $contarBibliografias = new \App\bib\Models\BibEstatisticas();
        $this->Dados['contarBiblio'] = $contarBibliografias->contarBibliografia();

        $contarEmprestimos = new \App\bib\Models\BibEstatisticas();
        $this->Dados['contarEmprestimo'] = $contarEmprestimos->contarEmprestimo();

        $contarCopias = new \App\bib\Models\BibEstatisticas();
        $this->Dados['contarCopias'] = $contarCopias->contarCopias();

        $contarAtrasos = new \App\bib\Models\BibEstatisticas();
        $this->Dados['contarAtrasos'] = $contarAtrasos->contarAtrasos();

        $listarRelatorio = new \App\bib\Models\BibRelatorioAtrasos();
        $this->Dados['listAtrasos'] = $listarRelatorio->listarAtrasos($this->PageId);
        $this->Dados['paginacao'] = $listarRelatorio->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/relatorio/estatisticas", $this->Dados);
        $carregarView->renderizar();
    }

}
