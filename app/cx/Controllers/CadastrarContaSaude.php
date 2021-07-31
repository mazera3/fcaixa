<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaSaude
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaSaude
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadSau'])) {
            unset($this->Dados['CadSau']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaSaude();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-saude/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadSauViewPriv();
            }
        } else {
            $this->cadSauViewPriv();
        }
    }

    private function cadSauViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaSaude();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_sau' => ['menu_controller' => 'conta-saude', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaSaude", $this->Dados);
        $carregarView->renderizar();
    }
}
