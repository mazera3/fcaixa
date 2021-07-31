<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaInformatica
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaInformatica
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadInf'])) {
            unset($this->Dados['CadInf']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaInformatica();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-informatica/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadInfViewPriv();
            }
        } else {
            $this->cadInfViewPriv();
        }
    }

    private function cadInfViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaInformatica();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_inf' => ['menu_controller' => 'conta-informatica', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaInformatica", $this->Dados);
        $carregarView->renderizar();
    }
}
