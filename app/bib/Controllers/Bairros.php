<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Bairro
 *
 * @copyright (c) year, Édio Mazera
 */
class Bairros
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_br' => ['menu_controller' => 'cadastrar-bairro', 'menu_metodo' => 'cad-bairro'],
            'vis_br' => ['menu_controller' => 'ver-bairro', 'menu_metodo' => 'ver-bairro'],
            'edit_br' => ['menu_controller' => 'editar-bairro', 'menu_metodo' => 'edit-bairro'],
            'del_br' => ['menu_controller' => 'apagar-bairro', 'menu_metodo' => 'apagar-bairro']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarBairro = new \App\bib\Models\BibListarBairro();
        $this->Dados['listBr'] = $listarBairro->listarBairro($this->PageId);
        $this->Dados['paginacao'] = $listarBairro->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/bairro/listarBairro", $this->Dados);
        $carregarView->renderizar();
    }

}
