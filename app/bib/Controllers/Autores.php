<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Autor
 *
 * @copyright (c) year, Édio Mazera
 */
class Autores
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_autor' => ['menu_controller' => 'cadastrar-autor', 'menu_metodo' => 'cad-autor'],
            'vis_autor' => ['menu_controller' => 'ver-autor', 'menu_metodo' => 'ver-autor'],
            'edit_autor' => ['menu_controller' => 'editar-autor', 'menu_metodo' => 'edit-autor'],
            'del_autor' => ['menu_controller' => 'apagar-autor', 'menu_metodo' => 'apagar-autor']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarAutor = new \App\bib\Models\BibListarAutor();
        $this->Dados['listAut'] = $listarAutor->listarAutor($this->PageId);
        $this->Dados['qtAut'] = $listarAutor->qtAutor();
        $this->Dados['paginacao'] = $listarAutor->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/autor/listarAutor", $this->Dados);
        $carregarView->renderizar();
    }

}
