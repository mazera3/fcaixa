<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarCatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarCatImovel
{

    private $Dados;

    public function cadCatImovel()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadImv'])) {
            unset($this->Dados['CadImv']);

            $cadImv = new \App\cx\Models\CxCadastrarCatImovel();
            $cadImv->cadImovel($this->Dados);
            if ($cadImv->getResultado()) {
                $UrlDestino = URLADM . 'cat-imovel/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadImvViewPriv();
            }
        } else {
            $this->cadImvViewPriv();
        }
    }

    private function cadImvViewPriv()
    {
        $botao = ['list_imv' => ['menu_controller' => 'cat-imovel', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/patrimonio/cadCatImovel", $this->Dados);
        $carregarView->renderizar();
    }
}
