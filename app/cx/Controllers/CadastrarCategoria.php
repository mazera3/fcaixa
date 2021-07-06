<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarCategoria
{

    private $Dados;

    public function cadCategoria()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadCat'])) {
            unset($this->Dados['CadCat']);
            
            $cadDes = new \App\cx\Models\CxCadastrarCategoria();
            $cadDes->cadCategoria($this->Dados);
            if ($cadDes->getResultado()) {
                $UrlDestino = URLADM . 'categoria/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadDesViewPriv();
            }
        } else {
            $this->cadDesViewPriv();
        }
    }

    private function cadDesViewPriv()
    {
        $botao = ['list_cat' => ['menu_controller' => 'categoria', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\cx\core\ConfigView("cx/Views/categoria/cadCategoria", $this->Dados);
        $carregarView->renderizar();
    }

}
