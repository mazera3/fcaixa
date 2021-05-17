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
class PesquisarCopias {

    private $Dados;
    private $DadosForm;
    private $PageId;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;
        $botao = [
            'cad_copia' => ['menu_controller' => 'cadastrar-copia','menu_metodo' => 'cad-copia'],
            'list_copia' => ['menu_controller' => 'copias','menu_metodo' => 'listar'],
            'vis_copia' => ['menu_controller' => 'ver-copia','menu_metodo' => 'ver-copia'],
            'edit_copia' => ['menu_controller' => 'editar-copia','menu_metodo' => 'edit-copia'],
            'del_copia' => ['menu_controller' => 'apagar-copia','menu_metodo' => 'apagar-copia']];

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
       
        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['PesqCopia'])) {
            unset($this->DadosForm['PesqCopia']);
        } else {
            $this->PageId = (int) $PageId ? $PageId : 1;
            $this->DadosForm['cod_bar'] = filter_input(INPUT_GET, 'cod_bar', FILTER_DEFAULT);
            $this->DadosForm['titulo'] = filter_input(INPUT_GET, 'titulo', FILTER_DEFAULT);
            $this->DadosForm['autor'] = filter_input(INPUT_GET, 'autor', FILTER_DEFAULT);
            $this->DadosForm['sub_titulo'] = filter_input(INPUT_GET, 'sub_titulo', FILTER_DEFAULT);
            $this->DadosForm['chamada'] = filter_input(INPUT_GET, 'chamada', FILTER_DEFAULT);
            $this->DadosForm['chave'] = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
        }

        $pesquisarCopias = new \App\bib\Models\BibPesquisarCopia();
        $this->Dados['listCopia'] = $pesquisarCopias->pesquisarCopias($this->PageId, $this->DadosForm);
        $this->Dados['paginacao'] = $pesquisarCopias->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/copia/pesquisarCopia", $this->Dados);
        $carregarView->renderizar();
    }

}
