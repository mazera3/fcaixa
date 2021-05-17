<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarAutor
{

    private $Dados;

    public function cadAutor()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadAutor'])) {
            unset($this->Dados['CadAutor']);
            $this->Dados['foto_nova'] = ($_FILES['foto_nova'] ? $_FILES['foto_nova'] : null);
            $cadMat = new \App\bib\Models\BibCadastrarAutor();
            $cadMat->cadAutor($this->Dados);
            if ($cadMat->getResultado()) {
                $UrlDestino = URLADM . 'autores/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadAutViewPriv();
            }
        } else {
            $this->cadAutViewPriv();
        }
    }

    private function cadAutViewPriv()
    {
        $listarSelect = new \App\bib\Models\BibCadastrarAutor();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
        
        $botao = ['list_aut' => ['menu_controller' => 'autores', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/autor/cadAutor", $this->Dados);
        $carregarView->renderizar();
    }

}
