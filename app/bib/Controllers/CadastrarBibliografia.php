<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarBibliografia
 *
 * @copyright (c) year, Édio mazera
 */
class CadastrarBibliografia
{

    private $Dados;

    public function cadBibliografia()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadBibliografia'])) {
            unset($this->Dados['CadBibliografia']);
            $this->Dados['capa_nova'] = ($_FILES['capa_nova'] ? $_FILES['capa_nova'] : null);
            $cadBibliografia = new \App\bib\Models\BibCadastrarBibliografia();
            $cadBibliografia->cadBibliografia($this->Dados);
            if ($cadBibliografia->getResultado()) {
                $UrlDestino = URLADM . 'bibliografias/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadBibliografiaViewPriv();
            }
        } else {
            $this->cadBibliografiaViewPriv();
        }
    }

    private function cadBibliografiaViewPriv()
    {
        $listarSelect = new \App\bib\Models\BibCadastrarBibliografia();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
       
        $botao = [
            'list_bibliografia' => ['menu_controller' => 'bibliografias', 'menu_metodo' => 'listar'],
            'cad_autor_modal' => ['menu_controller' => 'cadastrar-autor-modal', 'menu_metodo' => 'cad-autor'],
            'cad_editora_modal' => ['menu_controller' => 'cadastrar-editora-modal', 'menu_metodo' => 'cad-editora']
            ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $listarSelect2 = new \App\bib\Models\BibCadastrarAutorModal();
        $this->Dados['selectAutor'] = $listarSelect2->listarCadastrar();
        
        $listarSelect3 = new \App\bib\Models\BibCadastrarEditoraModal();
        $this->Dados['selectEditora'] = $listarSelect3->listarCadastrar();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/bibliografia/cadBibliografia", $this->Dados);
        $carregarView->renderizar();
    }

}
