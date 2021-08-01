<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaLoja
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaLoja
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadLoj'])) {
            unset($this->Dados['CadLoj']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaLoja();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-loja/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadLojViewPriv();
            }
        } else {
            $this->cadLojViewPriv();
        }
    }

    private function cadLojViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaLoja();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_loj' => ['menu_controller' => 'conta-loja', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaLoja", $this->Dados);
        $carregarView->renderizar();
    }
}
