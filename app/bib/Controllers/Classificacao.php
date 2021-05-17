<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Classificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class Classificacao
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_class' => ['menu_controller' => 'cadastrar-classificacao', 'menu_metodo' => 'cad-classificacao'],
            'vis_class' => ['menu_controller' => 'ver-classificacao', 'menu_metodo' => 'ver-classificacao'],
            'edit_class' => ['menu_controller' => 'editar-classificacao', 'menu_metodo' => 'edit-classificacao'],
            'del_class' => ['menu_controller' => 'apagar-classificacao', 'menu_metodo' => 'apagar-classificacao']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarClassificacao = new \App\bib\Models\BibListarClassificacao();
        $this->Dados['listClass'] = $listarClassificacao->listarClassificacao($this->PageId);
        $this->Dados['paginacao'] = $listarClassificacao->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/classificacao/listarClassificacao", $this->Dados);
        $carregarView->renderizar();
    }

}
