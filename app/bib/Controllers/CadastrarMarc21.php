<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarMarc21
 *
 * @copyright (c) year, Édio mazera
 */
class CadastrarMarc21 {

    private $Dados;

    public function marc21() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadMarc'])) {
            unset($this->Dados['CadMarc']);
            //var_dump($this->Dados);
            $cadMarc21 = new \App\bib\Models\BibCadastrarMarc21();
            $cadMarc21->cadMarc21($this->Dados);
            if ($cadMarc21->getResultado()) {
                $UrlDestino = URLADM . 'cadastrar-marc21/marc21';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadMarc21ViewPriv();
            }
        } else {
            $this->cadMarc21ViewPriv();
        }
    }

    private function cadMarc21ViewPriv() {

        // $listarSelect = new \App\bib\Models\BibCadastrarMarc21();
        //  $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'list_bibliografia' => ['menu_controller' => 'bibliografias', 'menu_metodo' => 'listar']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/bibliografia/cadMarc21", $this->Dados);
        $carregarView->renderizar();
    }

}
