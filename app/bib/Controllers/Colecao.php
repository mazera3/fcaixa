<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Colecao
 *
 * @copyright (c) year, Édio Mazera
 */
class Colecao
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_col' => ['menu_controller' => 'cadastrar-colecao', 'menu_metodo' => 'cad-colecao'],
            'vis_col' => ['menu_controller' => 'ver-colecao', 'menu_metodo' => 'ver-colecao'],
            'edit_col' => ['menu_controller' => 'editar-colecao', 'menu_metodo' => 'edit-colecao'],
            'del_col' => ['menu_controller' => 'apagar-colecao', 'menu_metodo' => 'apagar-colecao']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarColecao = new \App\bib\Models\BibListarColecao();
        $this->Dados['listCol'] = $listarColecao->listarColecao($this->PageId);
        $this->Dados['qtCol'] = $listarColecao->qtColecao();
        $this->Dados['contCol'] = $listarColecao->contarColecao();
        $this->Dados['paginacao'] = $listarColecao->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/colecao/listarColecao", $this->Dados);
        $carregarView->renderizar();
    }

}
