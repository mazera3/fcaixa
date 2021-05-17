<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarLeitor
 *
 * @copyright (c) year, Édio mazera
 */
class CadastrarLeitor
{

    private $Dados;

    public function cadLeitor()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadLeitor'])) {
            unset($this->Dados['CadLeitor']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadLeitor = new \App\bib\Models\BibCadastrarLeitor();
            $cadLeitor->cadLeitor($this->Dados);
            if ($cadLeitor->getResultado()) {
                $UrlDestino = URLADM . 'leitores/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadLeitorViewPriv();
            }
        } else {
            $this->cadLeitorViewPriv();
        }
    }

    private function cadLeitorViewPriv()
    {
        $listarSelect = new \App\bib\Models\BibCadastrarLeitor();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
       
        $botao = ['list_leitor' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/leitor/cadLeitor", $this->Dados);
        $carregarView->renderizar();
    }

}
