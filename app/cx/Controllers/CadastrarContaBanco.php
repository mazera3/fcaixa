<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaBanco
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaBanco
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadBan'])) {
            unset($this->Dados['CadBan']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaBanco();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-banco/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadBanViewPriv();
            }
        } else {
            $this->cadBanViewPriv();
        }
    }

    private function cadBanViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaBanco();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_ban' => ['menu_controller' => 'conta-banco', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/extras/cadContaBanco", $this->Dados);
        $carregarView->renderizar();
    }
}
