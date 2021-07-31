<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaEnergia
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadEne'])) {
            unset($this->Dados['CadEne']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaEnergia();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-energia/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadEneViewPriv();
            }
        } else {
            $this->cadEneViewPriv();
        }
    }

    private function cadEneViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaEnergia();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_ene' => ['menu_controller' => 'conta-energia', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaEnergia", $this->Dados);
        $carregarView->renderizar();
    }
}
