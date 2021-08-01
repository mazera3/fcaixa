<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaFone
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaFone
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadFon'])) {
            unset($this->Dados['CadFon']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaFone();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-fone/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadFonViewPriv();
            }
        } else {
            $this->cadFonViewPriv();
        }
    }

    private function cadFonViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaFone();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_fon' => ['menu_controller' => 'conta-fone', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaFone", $this->Dados);
        $carregarView->renderizar();
    }
}
