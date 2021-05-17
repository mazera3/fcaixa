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

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'imprimir' => ['menu_controller' => 'imprimir', 'menu_metodo' => 'imprimir']
        ];
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
