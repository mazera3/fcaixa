<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Editora
 *
 * @copyright (c) year, Édio Mazera
 */
class Editoras {

    private $Dados;
    private $PageId;
    private $DadosPdf;
    private $DadosXls;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_edi' => ['menu_controller' => 'cadastrar-editora', 'menu_metodo' => 'cad-editora'],
            'vis_edi' => ['menu_controller' => 'ver-editora', 'menu_metodo' => 'ver-editora'],
            'edit_edi' => ['menu_controller' => 'editar-editora', 'menu_metodo' => 'edit-editora'],
            'del_edi' => ['menu_controller' => 'apagar-editora', 'menu_metodo' => 'apagar-editora'],
            'pdf' => ['menu_controller' => 'editoras', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'editoras', 'menu_metodo' => 'listar']
        ];
        $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\bib\Models\BibPdfEditoras();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\bib\Models\BibXlsEditoras();
            $imprime->xls($this->DadosXls);
        }
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarEditora = new \App\bib\Models\BibListarEditora();
        $this->Dados['listEd'] = $listarEditora->listarEditora($this->PageId);
        $this->Dados['paginacao'] = $listarEditora->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/editora/listarEditora", $this->Dados);
        $carregarView->renderizar();
    }

}
