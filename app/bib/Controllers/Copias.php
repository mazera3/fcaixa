<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Copias
 *
 * @author mazera
 */
class Copias {

    private $Dados;
    private $PageId;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;
        $botao = [
            'cad_copia' => ['menu_controller' => 'cadastrar-copia','menu_metodo' => 'cad-copia'],
            'pesq_copia' => ['menu_controller' => 'pesquisar-copias','menu_metodo' => 'listar'],
            'edit_copia' => ['menu_controller' => 'editar-copia','menu_metodo' => 'edit-copia'],
            'del_copia' => ['menu_controller' => 'apagar-copia','menu_metodo' => 'apagar-copia']
            ];

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarCopias = new \App\bib\Models\BibListarCopia();
        $this->Dados['listCopia'] = $listarCopias->listarCopia($this->PageId);
        $this->Dados['paginacao'] = $listarCopias->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/copia/listarCopia", $this->Dados);
        $carregarView->renderizar();
    }

}
