<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Instituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class Instituicao
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_instituicao' => ['menu_controller' => 'cadastrar-instituicao', 'menu_metodo' => 'cad-instituicao'],
            'vis_instituicao' => ['menu_controller' => 'ver-instituicao', 'menu_metodo' => 'ver-instituicao'],
            'edit_instituicao' => ['menu_controller' => 'editar-instituicao', 'menu_metodo' => 'edit-instituicao'],
            'del_instituicao' => ['menu_controller' => 'apagar-instituicao', 'menu_metodo' => 'apagar-instituicao']
            ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarInstituicao = new \App\bib\Models\BibListarInstituicao();
        $this->Dados['dadosInstituicao'] = $listarInstituicao->listar($this->PageId);
        $this->Dados['paginacao'] = $listarInstituicao->getResultadoPg();
        
        $contInstituicao = new \App\bib\Models\BibApagarInstituicao();
        $this->Dados['contInstituicao'] = $contInstituicao->contaInstituicaoCad();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/listarInstituicao", $this->Dados);
        $carregarView->renderizar();
    }

}
