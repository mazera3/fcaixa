<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaCombustivel
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaCombustivel
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadComb'])) {
            unset($this->Dados['CadComb']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaCombustivel();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-combustivel/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadCombViewPriv();
            }
        } else {
            $this->cadCombViewPriv();
        }
    }

    private function cadCombViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaCombustivel();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_comb' => ['menu_controller' => 'conta-combustivel', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaCombustivel", $this->Dados);
        $carregarView->renderizar();
    }
}
