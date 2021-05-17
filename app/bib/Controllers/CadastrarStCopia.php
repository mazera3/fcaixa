<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarStCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarStCopia {

    private $Dados;

    public function cadStCopia() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadStCopia'])) {
            unset($this->Dados['CadStCopia']);

            $cadStCopia = new \App\bib\Models\BibCadastrarStCopia();
            $cadStCopia->cadStCopia($this->Dados);
            if ($cadStCopia->getResultado()) {
                $UrlDestino = URLADM . 'situacoes/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadStCopiaViewPriv();
            }
        } else {
            $this->cadStCopiaViewPriv();
        }
    }

    private function cadStCopiaViewPriv() {
        
        $listarSelect = new \App\bib\Models\BibCadastrarStCopia();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_sits' => ['menu_controller' => 'situacoes', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/situacoes/cadStCopia", $this->Dados);
        $carregarView->renderizar();
    }

}
