<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarColecao
{

    private $Dados;

    public function cadColecao()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadColecao'])) {
            unset($this->Dados['CadColecao']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadCol = new \App\bib\Models\BibCadastrarColecao();
            $cadCol->cadColecao($this->Dados);
            if ($cadCol->getResultado()) {
                $UrlDestino = URLADM . 'colecao/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadColViewPriv();
            }
        } else {
            $this->cadColViewPriv();
        }
    }

    private function cadColViewPriv()
    {
        $botao = ['list_col' => ['menu_controller' => 'colecao', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/colecao/cadColecao", $this->Dados);
        $carregarView->renderizar();
    }

}
