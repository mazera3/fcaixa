<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarEditora
{

    private $Dados;

    public function cadEditora()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadEd'])) {
            unset($this->Dados['CadEd']);
            $this->Dados['editora_nova'] = ($_FILES['editora_nova'] ? $_FILES['editora_nova'] : null);
            $cadEd = new \App\bib\Models\BibCadastrarEditora();
            $cadEd->cadEditora($this->Dados);
            if ($cadEd->getResultado()) {
                $UrlDestino = URLADM . 'editoras/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadEdViewPriv();
            }
        } else {
            $this->cadEdViewPriv();
        }
    }

    private function cadEdViewPriv()
    {
        $listarSelect = new \App\bib\Models\BibCadastrarEditora();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
        
        $botao = ['list_ed' => ['menu_controller' => 'editoras', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/editora/cadEditora", $this->Dados);
        $carregarView->renderizar();
    }

}
