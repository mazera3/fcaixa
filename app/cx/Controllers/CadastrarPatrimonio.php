<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarPatrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarPatrimonio
{

    private $Dados;

    public function cadPatrimonio()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadPat'])) {
            unset($this->Dados['CadPat']);
            
            $cadDes = new \App\cx\Models\CxCadastrarPatrimonio();
            $cadDes->cadPatrimonio($this->Dados);
            if ($cadDes->getResultado()) {
                $UrlDestino = URLADM . 'patrimonio/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadDesViewPriv();
            }
        } else {
            $this->cadDesViewPriv();
        }
    }

    private function cadDesViewPriv()
    {
        $listarSelect = new \App\cx\Models\CxCadastrarPatrimonio();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_pat' => ['menu_controller' => 'patrimonio', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\cx\core\ConfigView("cx/Views/patrimonio/cadPatrimonio", $this->Dados);
        $carregarView->renderizar();
    }

}
