<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Autor
 *
 * @copyright (c) year, Édio Mazera
 */
class Autores
{

    private $Dados;
    private $PageId;
    private $DadosPdf;
    private $DadosXls;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_autor' => ['menu_controller' => 'cadastrar-autor', 'menu_metodo' => 'cad-autor'],
            'vis_autor' => ['menu_controller' => 'ver-autor', 'menu_metodo' => 'ver-autor'],
            'edit_autor' => ['menu_controller' => 'editar-autor', 'menu_metodo' => 'edit-autor'],
            'del_autor' => ['menu_controller' => 'apagar-autor', 'menu_metodo' => 'apagar-autor'],
            'pdf' => ['menu_controller' => 'autores', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'autores', 'menu_metodo' => 'listar']
            ];
        $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\bib\Models\BibPdfAutores();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\bib\Models\BibXlsAutores();
            $imprime->xls($this->DadosXls);
        }
        
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarAutor = new \App\bib\Models\BibListarAutor();
        $this->Dados['listAut'] = $listarAutor->listarAutor($this->PageId);
        $this->Dados['qtAut'] = $listarAutor->qtAutor();
        $this->Dados['paginacao'] = $listarAutor->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/autor/listarAutor", $this->Dados);
        $carregarView->renderizar();
    }

}
