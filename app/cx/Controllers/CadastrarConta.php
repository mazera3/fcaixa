<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarConta
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarConta
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadCon'])) {
            unset($this->Dados['CadCon']);
            
            $cadDes = new \App\cx\Models\CxCadastrarConta();
            $cadDes->cadConta($this->Dados);
            if ($cadDes->getResultado()) {
                $UrlDestino = URLADM . 'contas/listar';
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
        $botao = ['list_con' => ['menu_controller' => 'contas', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadConta", $this->Dados);
        $carregarView->renderizar();
    }

}
