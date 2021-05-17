<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Uf
 *
 * @copyright (c) year, Édio Mazera
 */
class Uf
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_uf' => ['menu_controller' => 'cadastrar-uf', 'menu_metodo' => 'cad-uf'],
            'vis_uf' => ['menu_controller' => 'ver-uf', 'menu_metodo' => 'ver-uf'],
            'edit_uf' => ['menu_controller' => 'editar-uf', 'menu_metodo' => 'edit-uf'],
            'del_uf' => ['menu_controller' => 'apagar-uf', 'menu_metodo' => 'apagar-uf']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarUf = new \App\bib\Models\BibListarUf();
        $this->Dados['listUf'] = $listarUf->listarUf($this->PageId);
        $this->Dados['paginacao'] = $listarUf->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/uf/listarUf", $this->Dados);
        $carregarView->renderizar();
    }

}
