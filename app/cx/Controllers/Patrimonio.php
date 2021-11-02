<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Patrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class Patrimonio
{

    private $Dados;
    private $PageId;
    private $UserId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;
        $this->UserId = (int) $_SESSION['usuario_id'];

        $botao = [
            'cad_pat' => ['menu_controller' => 'cadastrar-patrimonio', 'menu_metodo' => 'cad-patrimonio'],
            'vis_pat' => ['menu_controller' => 'ver-patrimonio', 'menu_metodo' => 'ver-patrimonio'],
            'edit_pat' => ['menu_controller' => 'editar-patrimonio', 'menu_metodo' => 'edit-patrimonio'],
            'del_pat' => ['menu_controller' => 'apagar-patrimonio', 'menu_metodo' => 'apagar-patrimonio']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarPatrimonio = new \App\cx\Models\CxListarPatrimonio();
        $this->Dados['listPat'] = $listarPatrimonio->listarPatrimonio($this->PageId, $this->UserId);
        $this->Dados['paginacao'] = $listarPatrimonio->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/patrimonio/listarPatrimonio", $this->Dados);
        $carregarView->renderizar();
    }
}
