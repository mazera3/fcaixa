<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Descricao
 *
 * @copyright (c) year, Édio Mazera
 */
class Descricao
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_des' => ['menu_controller' => 'cadastrar-descricao', 'menu_metodo' => 'cad-descricao'],
            'vis_des' => ['menu_controller' => 'ver-descricao', 'menu_metodo' => 'ver-descricao'],
            'edit_des' => ['menu_controller' => 'editar-descricao', 'menu_metodo' => 'edit-descricao'],
            'del_des' => ['menu_controller' => 'apagar-descricao', 'menu_metodo' => 'apagar-descricao']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarDescricao = new \App\cx\Models\CxListarDescricao();
        $this->Dados['listDes'] = $listarDescricao->listarDescricao($this->PageId);
        $this->Dados['paginacao'] = $listarDescricao->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/descricao/listarDescricao", $this->Dados);
        $carregarView->renderizar();
    }

}
