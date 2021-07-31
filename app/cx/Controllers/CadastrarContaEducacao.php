<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarContaEducacao
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarContaEducacao
{

    private $Dados;

    public function cadConta()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadEdu'])) {
            unset($this->Dados['CadEdu']);

            $cadEnt = new \App\cx\Models\CxCadastrarContaEducacao();
            $cadEnt->cadConta($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'conta-educacao/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadEduViewPriv();
            }
        } else {
            $this->cadEduViewPriv();
        }
    }

    private function cadEduViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarContaEducacao();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_edu' => ['menu_controller' => 'conta-educacao', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/cadContaEducacao", $this->Dados);
        $carregarView->renderizar();
    }
}
