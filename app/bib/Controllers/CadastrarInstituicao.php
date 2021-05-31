<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarInstituicao
{

    private $Dados;

    public function cadInstituicao()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadInstituicao'])) {
            unset($this->Dados['CadInstituicao']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadInstituicao = new \App\bib\Models\BibCadastrarInstituicao();
            $cadInstituicao->cadInstituicao($this->Dados);
            if ($cadInstituicao->getResultado()) {
                $UrlDestino = URLADM . 'instituicao/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadInstituicaoViewPriv();
            }
        } else {
            $this->cadInstituicaoViewPriv();
        }
    }

    private function cadInstituicaoViewPriv()
    {
        $botao = ['list_instituicao' => ['menu_controller' => 'instituicao', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/cadInstituicao", $this->Dados);
        $carregarView->renderizar();
    }

}
