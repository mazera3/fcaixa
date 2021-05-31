<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Configurar
 *
 * @copyright (c) year, Édio Mazera
 */
class Configurar {

    private $Dados;

    public function config() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['Configurar'])) {
            unset($this->Dados['Configurar']);
            
            $conf = new \App\bib\Models\BibConfigurar();
            $conf->altConfig($this->Dados);
            if ($conf->getResultado()) {
                $UrlDestino = URLADM . 'listar-biblioteca/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->configViewPriv();
            }
        } else {
            $this->configViewPriv();
        }
    }

    private function configViewPriv() {
        
        $listarSelect = new \App\bib\Models\BibConfigurar();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
        
        $conf = new \App\bib\Models\BibConfigurar();
        $this->Dados['list_bib'] = $conf->config($this->Dados);
        
        $botao = ['list_biblioteca' => ['menu_controller' => 'listar-biblioteca', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/configurar", $this->Dados);
        $carregarView->renderizar();
    }

}
