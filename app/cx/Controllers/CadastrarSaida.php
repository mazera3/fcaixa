<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarSaida
{

    private $Dados;

    public function cadSaida()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadSai'])) {
            unset($this->Dados['CadSai']);

            $cadSai = new \App\cx\Models\CxCadastrarSaida();
            $cadSai->cadSaida($this->Dados);
            if ($cadSai->getResultado()) {
                $UrlDestino = URLADM . 'saida/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadSaiViewPriv();
            }
        } else {
            $this->cadSaiViewPriv();
        }
    }

    private function cadSaiViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarSaida();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_sai' => ['menu_controller' => 'saida', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/saida/cadSaida", $this->Dados);
        $carregarView->renderizar();
    }
}
