<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Relatorio
 *
 * @copyright (c) year, Édio Mazera
 */
class RelatorioAtrasos
{

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

        $listarRelatorio = new \App\bib\Models\BibRelatorioAtrasos();
        $this->Dados['listAtrasos'] = $listarRelatorio->listarAtrasos($this->PageId);
        $this->Dados['paginacao'] = $listarRelatorio->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/relatorio/relatorioAtrasos", $this->Dados);
        $carregarView->renderizar();
    }

}
