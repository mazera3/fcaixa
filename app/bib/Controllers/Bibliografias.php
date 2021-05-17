<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Bibliografias
 *
 * @copyright (c) year, Édio Mazera
 */
class Bibliografias {

    private $Dados;
    private $PageId;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_bibliografia' => ['menu_controller' => 'cadastrar-bibliografia', 'menu_metodo' => 'cad-bibliografia'],
            'imp_biblio' => ['menu_controller' => 'importar-bibliografia', 'menu_metodo' => 'importar'],
            'pesq_copia' => ['menu_controller' => 'pesquisar-copias', 'menu_metodo' => 'listar'],
            'vis_bibliografia' => ['menu_controller' => 'ver-bibliografia', 'menu_metodo' => 'ver-bibliografia'],
            'edit_bibliografia' => ['menu_controller' => 'editar-bibliografia', 'menu_metodo' => 'edit-bibliografia'],
            'del_bibliografia' => ['menu_controller' => 'apagar-bibliografia', 'menu_metodo' => 'apagar-bibliografia']];

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarBibliografias = new \App\bib\Models\BibListarBibliografia();
        $this->Dados['listBiblio'] = $listarBibliografias->listarBibliografia($this->PageId);
        $this->Dados['qtBiblio'] = $listarBibliografias->qtBiblio();
        $this->Dados['contCopia'] = $listarBibliografias->contarCopia();
        $this->Dados['paginacao'] = $listarBibliografias->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/bibliografia/listarBibliografia", $this->Dados);
        $carregarView->renderizar();
    }

}
