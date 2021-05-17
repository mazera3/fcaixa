<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarBairro
{

    private $Dados;

    public function cadBairro()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadBairro'])) {
            unset($this->Dados['CadBairro']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadBr = new \App\bib\Models\BibCadastrarBairro();
            $cadBr->cadBairro($this->Dados);
            if ($cadBr->getResultado()) {
                $UrlDestino = URLADM . 'bairros/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadBrViewPriv();
            }
        } else {
            $this->cadBrViewPriv();
        }
    }

    private function cadBrViewPriv()
    {
        $listarSelect = new \App\bib\Models\BibCadastrarBairro();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
        
        $botao = ['list_br' => ['menu_controller' => 'bairros', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/bairro/cadBairro", $this->Dados);
        $carregarView->renderizar();
    }

}
