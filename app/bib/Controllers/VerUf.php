<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerUf
 *
 * @copyright (c) year, Édio Mazera
 */
class VerUf
{

    private $Dados;
    private $DadosId;

    public function verUf($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verUf = new \App\bib\Models\BibVerUf();
            $this->Dados['dados_uf'] = $verUf->verUf($this->DadosId);           
            
            $botao = ['list_uf' => ['menu_controller' => 'uf', 'menu_metodo' => 'listar'],
                'edit_uf' => ['menu_controller' => 'editar-uf', 'menu_metodo' => 'edit-uf'],
                'del_uf' => ['menu_controller' => 'apagar-uf', 'menu_metodo' => 'apagar-uf']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/uf/verUf", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Uf não encontrado!</div>";
            $UrlDestino = URLADM . 'uf/listar';
            header("Location: $UrlDestino");
        }
    }

}
