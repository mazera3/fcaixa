<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarStLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarStLeitor {

    private $Dados;

    public function cadStLeitor() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadStLeitor'])) {
            unset($this->Dados['CadStLeitor']);

            $cadStLeitor = new \App\bib\Models\BibCadastrarStLeitor();
            $cadStLeitor->cadStLeitor($this->Dados);
            if ($cadStLeitor->getResultado()) {
                $UrlDestino = URLADM . 'situacoes/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadStLeitorViewPriv();
            }
        } else {
            $this->cadStLeitorViewPriv();
        }
    }

    private function cadStLeitorViewPriv() {
        
        $listarSelect = new \App\bib\Models\BibCadastrarStLeitor();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_sits' => ['menu_controller' => 'situacoes', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/situacoes/cadStLeitor", $this->Dados);
        $carregarView->renderizar();
    }

}
