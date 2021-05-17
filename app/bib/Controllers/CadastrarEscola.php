<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarEscola
{

    private $Dados;

    public function cadEscola()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadEscola'])) {
            unset($this->Dados['CadEscola']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadEscola = new \App\bib\Models\BibCadastrarEscola();
            $cadEscola->cadEscola($this->Dados);
            if ($cadEscola->getResultado()) {
                $UrlDestino = URLADM . 'escola/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadEscolaViewPriv();
            }
        } else {
            $this->cadEscolaViewPriv();
        }
    }

    private function cadEscolaViewPriv()
    {
        $botao = ['list_escola' => ['menu_controller' => 'escola', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/escola/cadEscola", $this->Dados);
        $carregarView->renderizar();
    }

}
