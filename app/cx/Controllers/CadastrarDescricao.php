<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarDescricao
{

    private $Dados;

    public function cadDescricao()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadDes'])) {
            unset($this->Dados['CadDes']);
            
            $cadDes = new \App\cx\Models\CxCadastrarDescricao();
            $cadDes->cadDescricao($this->Dados);
            if ($cadDes->getResultado()) {
                $UrlDestino = URLADM . 'descricao/listar';
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
        $listarSelect = new \App\cx\Models\CxCadastrarDescricao();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_des' => ['menu_controller' => 'descricao', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\cx\core\ConfigView("cx/Views/descricao/cadDescricao", $this->Dados);
        $carregarView->renderizar();
    }

}
