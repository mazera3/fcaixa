<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CodigoBar
 *
 * @copyright (c) year, Édio Mazera
 */
class CodigoBar {

    private $DadosCD;
    private $Dados;

    public function codigoBar() {

        $this->DadosCD = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosCD['CodeBar'])) {
            unset($this->DadosCD['CodeBar']);
            $codeBar = new \App\cx\Models\CxCodeBar();
            $this->Dados['listCodBar'] = $codeBar->geraCodeBar($this->DadosCD);
        }

        $botao = ['cod_bar' => ['menu_controller' => 'codebar', 'menu_metodo' => 'codebar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/codebar/codebar", $this->Dados);
        $carregarView->renderizar();
    }
}
