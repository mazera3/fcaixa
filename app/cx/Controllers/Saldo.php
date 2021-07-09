<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Saldo
 *
 * @copyright (c) year, Édio Mazera
 */
class Saldo
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_sal' => ['menu_controller' => 'cadastrar-saldo', 'menu_metodo' => 'cad-saldo'],
            'edit_sal' => ['menu_controller' => 'editar-saldo', 'menu_metodo' => 'edit-saldo'],
            'del_sal' => ['menu_controller' => 'apagar-saldo', 'menu_metodo' => 'apagar-saldo']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarSaldo = new \App\cx\Models\CxListarSaldo();
        $this->Dados['listSal'] = $listarSaldo->listarSaldo($this->PageId);
        $this->Dados['paginacao'] = $listarSaldo->getResultadoPg();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/saldo/listarSaldo", $this->Dados);
        $carregarView->renderizar();
    }

}
