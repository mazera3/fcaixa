<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Contas
 *
 * @copyright (c) year, Édio Mazera
 */
class Contas
{

    private $Dados;

    public function listar()
    {

        $botao = [
            'cad_con' => ['menu_controller' => 'cadastrar-conta', 'menu_metodo' => 'cad-conta'],
            'del_con' => ['menu_controller' => 'apagar-conta', 'menu_metodo' => 'apagar-conta'],
            'ger_con' => ['menu_controller' => 'gerar-conta', 'menu_metodo' => 'gerar']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarConta = new \App\cx\Models\CxContas();
        $this->Dados['listCon'] = $listarConta->listarConta();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContas", $this->Dados);
        $carregarView->renderizar();
    }
}
