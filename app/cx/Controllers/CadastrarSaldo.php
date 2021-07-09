<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarSaldo
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarSaldo
{

    private $Dados;

    public function cadSaldo()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadSal'])) {
            unset($this->Dados['CadSal']);
            
            $cadSal = new \App\cx\Models\CxCadastrarSaldo();
            $cadSal->cadSaldo($this->Dados);
            if ($cadSal->getResultado()) {
                $UrlDestino = URLADM . 'saldo/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadSalViewPriv();
            }
        } else {
            $this->cadSalViewPriv();
        }
    }

    private function cadSalViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarSaldo();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_sal' => ['menu_controller' => 'saldo', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\cx\core\ConfigView("cx/Views/saldo/cadSaldo", $this->Dados);
        $carregarView->renderizar();
    }

}
