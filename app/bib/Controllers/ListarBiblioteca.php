<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ListarBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class ListarBiblioteca
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_biblioteca' => ['menu_controller' => 'cadastrar-biblioteca', 'menu_metodo' => 'cad-biblioteca'],
            'configurar' => ['menu_controller' => 'configurar', 'menu_metodo' => 'config'],
            'vis_biblioteca' => ['menu_controller' => 'ver-biblioteca', 'menu_metodo' => 'ver-biblioteca'],
            'edit_biblioteca' => ['menu_controller' => 'editar-biblioteca', 'menu_metodo' => 'edit-biblioteca'],
            'del_biblioteca' => ['menu_controller' => 'apagar-biblioteca', 'menu_metodo' => 'apagar-biblioteca']
            ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarBiblioteca = new \App\bib\Models\BibListarBiblioteca();
        $this->Dados['dadosBiblioteca'] = $listarBiblioteca->listar($this->PageId);
        $this->Dados['paginacao'] = $listarBiblioteca->getResultadoPg();
        
        $contBiblioteca = new \App\bib\Models\BibApagarBiblioteca();
        $this->Dados['contBiblioteca'] = $contBiblioteca->contaBibliotecaCad();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/listarBiblioteca", $this->Dados);
        $carregarView->renderizar();
    }

}
