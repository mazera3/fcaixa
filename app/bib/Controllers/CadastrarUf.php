<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarUf
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarUf {

    private $Dados;

    public function cadUf() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadUf'])) {
            unset($this->Dados['CadUf']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadMun = new \App\bib\Models\BibCadastrarUf();
            $cadMun->cadUf($this->Dados);
            if ($cadMun->getResultado()) {
                $UrlDestino = URLADM . 'uf/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadUfViewPriv();
            }
        } else {
            $this->cadUfViewPriv();
        }
    }

    private function cadUfViewPriv() {
        
        $listarSelect = new \App\bib\Models\BibCadastrarUf();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_uf' => ['menu_controller' => 'uf', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/uf/cadUf", $this->Dados);
        $carregarView->renderizar();
    }

}
