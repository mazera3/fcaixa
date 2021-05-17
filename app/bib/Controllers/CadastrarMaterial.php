<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarMaterial
{

    private $Dados;

    public function cadMaterial()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadMaterial'])) {
            unset($this->Dados['CadMaterial']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadMat = new \App\bib\Models\BibCadastrarMaterial();
            $cadMat->cadMaterial($this->Dados);
            if ($cadMat->getResultado()) {
                $UrlDestino = URLADM . 'material/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadMatViewPriv();
            }
        } else {
            $this->cadMatViewPriv();
        }
    }

    private function cadMatViewPriv()
    {
        $botao = ['list_mat' => ['menu_controller' => 'material', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/material/cadMaterial", $this->Dados);
        $carregarView->renderizar();
    }

}
