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
class RelatorioHistorico
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

        $listarHistorico = new \App\bib\Models\BibRelatorioHistorico();
        $this->Dados['listHistorico'] = $listarHistorico->listarHistorico($this->PageId);
        $this->Dados['paginacao'] = $listarHistorico->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/relatorio/relatorioHistorico", $this->Dados);
        $carregarView->renderizar();
    }

}
