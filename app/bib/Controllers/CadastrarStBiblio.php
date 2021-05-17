<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarStBiblio
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarStBiblio {

    private $Dados;

    public function cadStBiblio() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadStBiblio'])) {
            unset($this->Dados['CadStBiblio']);

            $cadStBiblio = new \App\bib\Models\BibCadastrarStBiblio();
            $cadStBiblio->cadStBiblio($this->Dados);
            if ($cadStBiblio->getResultado()) {
                $UrlDestino = URLADM . 'situacoes/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadStBiblioViewPriv();
            }
        } else {
            $this->cadStBiblioViewPriv();
        }
    }

    private function cadStBiblioViewPriv() {
        
        $listarSelect = new \App\bib\Models\BibCadastrarStBiblio();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_sits' => ['menu_controller' => 'situacoes', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/situacoes/cadStBiblio", $this->Dados);
        $carregarView->renderizar();
    }

}
