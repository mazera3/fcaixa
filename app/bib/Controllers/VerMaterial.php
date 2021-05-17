<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class VerMaterial
{

    private $Dados;
    private $DadosId;

    public function verMaterial($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verMaterial = new \App\bib\Models\BibVerMaterial();
            $this->Dados['dados_mat'] = $verMaterial->verMaterial($this->DadosId);           
            
            $botao = ['list_mat' => ['menu_controller' => 'material', 'menu_metodo' => 'listar'],
                'edit_mat' => ['menu_controller' => 'editar-material', 'menu_metodo' => 'edit-material'],
                'del_mat' => ['menu_controller' => 'apagar-material', 'menu_metodo' => 'apagar-material']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/material/verMaterial", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Material não encontrado!</div>";
            $UrlDestino = URLADM . 'material/listar';
            header("Location: $UrlDestino");
        }
    }

}
