<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarClassificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarClassificacao
{

    private $Dados;

    public function cadClassificacao()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadClass'])) {
            unset($this->Dados['CadClass']);
            
            $cadClass = new \App\bib\Models\BibCadastrarClassificacao();
            $cadClass->cadClassificacao($this->Dados);
            if ($cadClass->getResultado()) {
                $UrlDestino = URLADM . 'classificacao/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadClassificacaoViewPriv();
            }
        } else {
            $this->cadClassificacaoViewPriv();
        }
    }

    private function cadClassificacaoViewPriv()
    {
        $botao = ['list_class' => ['menu_controller' => 'classificacao', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/classificacao/cadClassificacao", $this->Dados);
        $carregarView->renderizar();
    }

}
