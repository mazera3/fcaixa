<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Categoria
 *
 * @copyright (c) year, Édio Mazera
 */
class Categoria
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_cat' => ['menu_controller' => 'cadastrar-categoria', 'menu_metodo' => 'cad-categoria'],
            'vis_cat' => ['menu_controller' => 'ver-categoria', 'menu_metodo' => 'ver-categoria'],
            'edit_cat' => ['menu_controller' => 'editar-categoria', 'menu_metodo' => 'edit-categoria'],
            'del_cat' => ['menu_controller' => 'apagar-categoria', 'menu_metodo' => 'apagar-categoria']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarCategoria = new \App\cx\Models\CxListarCategoria();
        $this->Dados['listCat'] = $listarCategoria->listarCategoria($this->PageId);
        $this->Dados['paginacao'] = $listarCategoria->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/categoria/listarCategoria", $this->Dados);
        $carregarView->renderizar();
    }
}
