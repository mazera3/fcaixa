<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class VerBairro
{

    private $Dados;
    private $DadosId;

    public function verBairro($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verBairro = new \App\bib\Models\BibVerBairro();
            $this->Dados['dados_br'] = $verBairro->verBairro($this->DadosId);           
            
            $botao = ['list_br' => ['menu_controller' => 'bairros', 'menu_metodo' => 'listar'],
                'edit_br' => ['menu_controller' => 'editar-bairro', 'menu_metodo' => 'edit-bairro'],
                'del_br' => ['menu_controller' => 'apagar-bairro', 'menu_metodo' => 'apagar-bairro']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/bairro/verBairro", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bairro não encontrado!</div>";
            $UrlDestino = URLADM . 'bairros/listar';
            header("Location: $UrlDestino");
        }
    }

}
