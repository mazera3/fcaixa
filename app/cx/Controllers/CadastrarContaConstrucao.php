<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaConstrucao
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaConstrucao
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadCon'])) {
            unset($this->Dados['CadCon']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaConstrucao();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-construcao/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadConViewPriv();
            }
        } else {
            $this->cadConViewPriv();
        }
    }

    private function cadConViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaConstrucao();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_con' => ['menu_controller' => 'conta-construcao', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/extras/cadContaConstrucao", $this->Dados);
        $carregarView->renderizar();
    }
}
