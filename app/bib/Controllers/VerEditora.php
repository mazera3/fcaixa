<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class VerEditora
{

    private $Dados;
    private $DadosId;

    public function verEditora($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verEditora = new \App\bib\Models\BibVerEditora();
            $this->Dados['dados_editora'] = $verEditora->verEditora($this->DadosId);           
            
            $botao = ['list_editora' => ['menu_controller' => 'editoras', 'menu_metodo' => 'listar'],
                'edit_editora' => ['menu_controller' => 'editar-autor', 'menu_metodo' => 'edit-autor'],
                'del_editora' => ['menu_controller' => 'apagar-autor', 'menu_metodo' => 'apagar-autor']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/editora/verEditora", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Editora não encontrada!</div>";
            $UrlDestino = URLADM . 'editoras/listar';
            header("Location: $UrlDestino");
        }
    }

}
