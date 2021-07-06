<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Saida
 *
 * @copyright (c) year, Édio Mazera
 */
class Saida
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_sai' => ['menu_controller' => 'cadastrar-saida', 'menu_metodo' => 'cad-saida'],
            'vis_sai' => ['menu_controller' => 'ver-saida', 'menu_metodo' => 'ver-saida'],
            'edit_sai' => ['menu_controller' => 'editar-saida', 'menu_metodo' => 'edit-saida'],
            'del_sai' => ['menu_controller' => 'apagar-saida', 'menu_metodo' => 'apagar-saida']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarSaida = new \App\cx\Models\CxListarSaida();
        $this->Dados['listSai'] = $listarSaida->listarSaida($this->PageId);
        $this->Dados['paginacao'] = $listarSaida->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/saida/listarSaida", $this->Dados);
        $carregarView->renderizar();
    }

}
