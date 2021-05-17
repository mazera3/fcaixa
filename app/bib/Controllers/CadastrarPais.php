<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarPais
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarPais
{

    private $Dados;

    public function cadPais()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadPais'])) {
            unset($this->Dados['CadPais']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadPais = new \App\bib\Models\BibCadastrarPais();
            $cadPais->cadPais($this->Dados);
            if ($cadPais->getResultado()) {
                $UrlDestino = URLADM . 'pais/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadPaisViewPriv();
            }
        } else {
            $this->cadPaisViewPriv();
        }
    }

    private function cadPaisViewPriv()
    {
        $botao = ['list_pais' => ['menu_controller' => 'pais', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \App\bib\core\ConfigView("bib/Views/pais/cadPais", $this->Dados);
        $carregarView->renderizar();
    }

}
