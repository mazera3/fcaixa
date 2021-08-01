<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaMecanica
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaMecanica
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadMec'])) {
            unset($this->Dados['CadMec']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaMecanica();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-mecanica/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadMecViewPriv();
            }
        } else {
            $this->cadMecViewPriv();
        }
    }

    private function cadMecViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaMecanica();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_mec' => ['menu_controller' => 'conta-mecanica', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaMecanica", $this->Dados);
        $carregarView->renderizar();
    }
}
