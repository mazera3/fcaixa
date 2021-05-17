<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarCopia
 *
 * @copyright (c) year, Édio mazera
 */
class CadastrarCopia
{

    private $Dados;

    public function cadCopia()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if (!empty($this->Dados['CadCopia'])) {
            unset($this->Dados['CadCopia']);
            $cadCopia = new \App\bib\Models\BibCadastrarCopia();
            $cadCopia->cadCopia($this->Dados);
            if ($cadCopia->getResultado()) {
                //$UrlDestino = URLADM . 'bibliografias/listar';
                $UrlDestino = URLADM . 'ver-bibliografia/ver-bibliografia/' . $this->Dados['cop_bib_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadCopiaViewPriv();
            }
        } else {
            $this->cadCopiaViewPriv();
        }
    }

    private function cadCopiaViewPriv()
    {
       
        $botao = ['list_copia' => ['menu_controller' => 'copias', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/copia/cadCopia", $this->Dados);
        $carregarView->renderizar();
    }

}
