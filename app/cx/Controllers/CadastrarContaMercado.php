<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaMercado
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaMercado
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadMer'])) {
            unset($this->Dados['CadMer']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaMercado();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-mercado/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadMerViewPriv();
            }
        } else {
            $this->cadMerViewPriv();
        }
    }

    private function cadMerViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaMercado();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_mer' => ['menu_controller' => 'conta-mercado', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaMercado", $this->Dados);
        $carregarView->renderizar();
    }
}
