<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Biblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarBiblioteca {

    private $Dados;
    private $PageId;

    public function cadBiblioteca() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadBiblioteca'])) {
            unset($this->Dados['CadBiblioteca']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadBiblioteca = new \App\bib\Models\BibCadastrarBiblioteca();
            $cadBiblioteca->cadBiblioteca($this->Dados);
            if ($cadBiblioteca->getResultado()) {
                $UrlDestino = URLADM . 'listar-biblioteca/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadBibliotecaViewPriv();
            }
        } else {
            $this->cadBibliotecaViewPriv();
        }
    }

    private function cadBibliotecaViewPriv() {
        
        $listarSelect = new \App\bib\Models\BibCadastrarBiblioteca();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
        
        $botao = ['list_biblioteca' => ['menu_controller' => 'listar-biblioteca', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/cadBiblioteca", $this->Dados);
        $carregarView->renderizar();
    }

}
