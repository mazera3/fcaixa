<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Entrada
 *
 * @copyright (c) year, Édio Mazera
 */
class Entrada
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_ent' => ['menu_controller' => 'cadastrar-entrada', 'menu_metodo' => 'cad-entrada'],
            'vis_ent' => ['menu_controller' => 'ver-entrada', 'menu_metodo' => 'ver-entrada'],
            'edit_ent' => ['menu_controller' => 'editar-entrada', 'menu_metodo' => 'edit-entrada'],
            'del_ent' => ['menu_controller' => 'apagar-entrada', 'menu_metodo' => 'apagar-entrada']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarEntrada = new \App\cx\Models\CxListarEntrada();
        $this->Dados['listEnt'] = $listarEntrada->listarEntrada($this->PageId);
        $this->Dados['paginacao'] = $listarEntrada->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/entrada/listarEntrada", $this->Dados);
        $carregarView->renderizar();
    }

}
