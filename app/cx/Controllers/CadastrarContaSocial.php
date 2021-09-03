<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaSocial
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaSocial
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadSoc'])) {
            unset($this->Dados['CadSoc']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaSocial();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-social/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadSocViewPriv();
            }
        } else {
            $this->cadSocViewPriv();
        }
    }

    private function cadSocViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaSocial();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_soc' => ['menu_controller' => 'conta-social', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/extras/cadContaSocial", $this->Dados);
        $carregarView->renderizar();
    }
}
