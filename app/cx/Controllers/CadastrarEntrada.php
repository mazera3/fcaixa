<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarEntrada
{

    private $Dados;

    public function cadEntrada()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadEnt'])) {
            unset($this->Dados['CadEnt']);

            $cadEnt = new \App\cx\Models\CxCadastrarEntrada();
            $cadEnt->cadEntrada($this->Dados);
            if ($cadEnt->getResultado()) {
                $UrlDestino = URLADM . 'entrada/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadEntViewPriv();
            }
        } else {
            $this->cadEntViewPriv();
        }
    }

    private function cadEntViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarEntrada();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_ent' => ['menu_controller' => 'entrada', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/entrada/cadEntrada", $this->Dados);
        $carregarView->renderizar();
    }
}
