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

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'imprimir' => ['menu_controller' => 'imprimir', 'menu_metodo' => 'imprimir']
            ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $contarLeitores = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarLeitor'] = $contarLeitores->contarLeitor();

        $contarBibliografias = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarBiblio'] = $contarBibliografias->contarBibliografia();

        $contarEmprestimos = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarEmprestimo'] = $contarEmprestimos->contarEmprestimo();

        $contarCopias = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarCopias'] = $contarCopias->contarCopias();

        $contarAtrasos = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarAtrasos'] = $contarAtrasos->contarAtrasos();

       $listarRelatorio = new \App\bib\Models\BibRelatorioAtrasos();
        $this->Dados['listAtrasos'] = $listarRelatorio->listarAtrasos($this->PageId);
        $this->Dados['paginacao'] = $listarRelatorio->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/relatorio/estatisticas", $this->Dados);
        $carregarView->renderizar();
    }

}
