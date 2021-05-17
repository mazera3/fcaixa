<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Situacoes
 *
 * @copyright (c) year, Édio Mazera
 */
class Situacoes
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
           'cad_sits_biblio' => ['menu_controller' => 'cadastrar-st-biblio', 'menu_metodo' => 'cad-st-biblio'],
           'edit_sits_biblio' => ['menu_controller' => 'editar-st-biblio', 'menu_metodo' => 'edit-st-biblio'],
           'del_sits_biblio' => ['menu_controller' => 'apagar-st-biblio', 'menu_metodo' => 'apagar-st-biblio'],
            
           'cad_sits_copia' => ['menu_controller' => 'cadastrar-st-copia', 'menu_metodo' => 'cad-st-copia'],
           'edit_sits_copia' => ['menu_controller' => 'editar-st-copia', 'menu_metodo' => 'edit-st-copia'],
           'del_sits_copia' => ['menu_controller' => 'apagar-st-copia', 'menu_metodo' => 'apagar-st-copia'],
            
           'cad_sits_leitor' => ['menu_controller' => 'cadastrar-st-leitor', 'menu_metodo' => 'cad-st-leitor'],
           'edit_sits_leitor' => ['menu_controller' => 'editar-st-leitor', 'menu_metodo' => 'edit-st-leitor'],
           'del_sits_leitor' => ['menu_controller' => 'apagar-st-leitor', 'menu_metodo' => 'apagar-st-leitor']
            ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarSituacoesBiblio = new \App\bib\Models\BibListarSituacoes();
        $this->Dados['listStBiblio'] = $listarSituacoesBiblio->listarSituacoesBiblio($this->PageId);
        //$this->Dados['paginacao'] = $listarSituacoesBiblio->getResultadoPg();
        
        $listarSituacoesCopia = new \App\bib\Models\BibListarSituacoes();
        $this->Dados['listStCopia'] = $listarSituacoesCopia->listarSituacoesCopia($this->PageId);
        
        $listarSituacoesLeitor = new \App\bib\Models\BibListarSituacoes();
        $this->Dados['listStLeitor'] = $listarSituacoesLeitor->listarSituacoesLeitor($this->PageId);

        $carregarView = new \App\bib\core\ConfigView("bib/Views/situacoes/listarSituacao", $this->Dados);
        $carregarView->renderizar();
    }

}
