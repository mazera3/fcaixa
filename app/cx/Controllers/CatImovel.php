<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class CatImovel
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_imv' => ['menu_controller' => 'cadastrar-cat-imovel', 'menu_metodo' => 'cad-cat-imovel'],
            'vis_imv' => ['menu_controller' => 'ver-cat-imovel', 'menu_metodo' => 'ver-cat-imovel'],
            'edit_imv' => ['menu_controller' => 'editar-cat-imovel', 'menu_metodo' => 'edit-cat-imovel'],
            'del_imv' => ['menu_controller' => 'apagar-cat-imovel', 'menu_metodo' => 'apagar-cat-imovel']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarImovel = new \App\cx\Models\CxListarCatImovel();
        $this->Dados['listImv'] = $listarImovel->listarImovel($this->PageId);
        $this->Dados['paginacao'] = $listarImovel->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/patrimonio/listarCatImovel", $this->Dados);
        $carregarView->renderizar();
    }
}
