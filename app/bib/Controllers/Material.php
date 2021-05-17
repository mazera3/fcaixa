<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Material
 *
 * @copyright (c) year, Édio Mazera
 */
class Material
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_mat' => ['menu_controller' => 'cadastrar-material', 'menu_metodo' => 'cad-material'],
            'vis_mat' => ['menu_controller' => 'ver-material', 'menu_metodo' => 'ver-material'],
            'edit_mat' => ['menu_controller' => 'editar-material', 'menu_metodo' => 'edit-material'],
            'del_mat' => ['menu_controller' => 'apagar-material', 'menu_metodo' => 'apagar-material']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarMaterial = new \App\bib\Models\BibListarMaterial();
        $this->Dados['listMat'] = $listarMaterial->listarMaterial($this->PageId);
        $this->Dados['paginacao'] = $listarMaterial->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/material/listarMaterial", $this->Dados);
        $carregarView->renderizar();
    }

}
