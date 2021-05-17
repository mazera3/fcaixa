<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Municipio
 *
 * @copyright (c) year, Édio Mazera
 */
class Municipio
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_mun' => ['menu_controller' => 'cadastrar-municipio', 'menu_metodo' => 'cad-municipio'],
            'vis_mun' => ['menu_controller' => 'ver-municipio', 'menu_metodo' => 'ver-municipio'],
            'edit_mun' => ['menu_controller' => 'editar-municipio', 'menu_metodo' => 'edit-municipio'],
            'del_mun' => ['menu_controller' => 'apagar-municipio', 'menu_metodo' => 'apagar-municipio']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarMunicipio = new \App\bib\Models\BibListarMunicipio();
        $this->Dados['listMun'] = $listarMunicipio->listarMunicipio($this->PageId);
        $this->Dados['paginacao'] = $listarMunicipio->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/municipio/listarMunicipio", $this->Dados);
        $carregarView->renderizar();
    }

}
