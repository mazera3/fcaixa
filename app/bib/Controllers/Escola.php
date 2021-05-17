<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Escola
 *
 * @copyright (c) year, Édio Mazera
 */
class Escola
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_escola' => ['menu_controller' => 'cadastrar-escola', 'menu_metodo' => 'cad-escola'],
            'vis_escola' => ['menu_controller' => 'ver-escola', 'menu_metodo' => 'ver-escola'],
            'edit_escola' => ['menu_controller' => 'editar-escola', 'menu_metodo' => 'edit-escola'],
            'del_escola' => ['menu_controller' => 'apagar-escola', 'menu_metodo' => 'apagar-escola']
            ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarEscola = new \App\bib\Models\BibEscola();
        $this->Dados['dadosEscola'] = $listarEscola->listar();
        $this->Dados['paginacao'] = $listarEscola->getResultadoPg();
        
        $contEscola = new \App\bib\Models\BibApagarEscola();
        $this->Dados['contEscola'] = $contEscola->contaEscolaCad();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/escola/listarEscola", $this->Dados);
        $carregarView->renderizar();
    }

}
