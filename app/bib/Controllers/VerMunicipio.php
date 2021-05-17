<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class VerMunicipio
{

    private $Dados;
    private $DadosId;

    public function verMunicipio($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verMunicipio = new \App\bib\Models\BibVerMunicipio();
            $this->Dados['dados_mun'] = $verMunicipio->verMunicipio($this->DadosId);           
            
            $botao = ['list_mun' => ['menu_controller' => 'municipio', 'menu_metodo' => 'listar'],
                'edit_mun' => ['menu_controller' => 'editar-municipio', 'menu_metodo' => 'edit-municipio'],
                'del_mun' => ['menu_controller' => 'apagar-municipio', 'menu_metodo' => 'apagar-municipio']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/municipio/verMunicipio", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Municipio não encontrado!</div>";
            $UrlDestino = URLADM . 'municipio/listar';
            header("Location: $UrlDestino");
        }
    }

}
