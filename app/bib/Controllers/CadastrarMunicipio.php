<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarMunicipio
{

    private $Dados;

    public function cadMunicipio()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadMunicipio'])) {
            unset($this->Dados['CadMunicipio']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadMun = new \App\bib\Models\BibCadastrarMunicipio();
            $cadMun->cadMunicipio($this->Dados);
            if ($cadMun->getResultado()) {
                $UrlDestino = URLADM . 'municipio/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadMunViewPriv();
            }
        } else {
            $this->cadMunViewPriv();
        }
    }

    private function cadMunViewPriv()
    {
        $listarSelect = new \App\bib\Models\BibCadastrarMunicipio();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
        
        $botao = ['list_mun' => ['menu_controller' => 'municipio', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/municipio/cadMunicipio", $this->Dados);
        $carregarView->renderizar();
    }

}
