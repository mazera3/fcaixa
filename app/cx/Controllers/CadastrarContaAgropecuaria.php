<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaAgropecuaria
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaAgropecuaria
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadAgr'])) {
            unset($this->Dados['CadAgr']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaAgropecuaria();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-agropecuaria/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadAgrViewPriv();
            }
        } else {
            $this->cadAgrViewPriv();
        }
    }

    private function cadAgrViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaAgropecuaria();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_agr' => ['menu_controller' => 'conta-agropecuaria', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaAgropecuaria", $this->Dados);
        $carregarView->renderizar();
    }
}
