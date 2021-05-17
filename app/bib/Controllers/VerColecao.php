<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class VerColecao {

    private $Dados;
    private $DadosId;

    public function verColecao($DadosId = null) {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verColecao = new \App\bib\Models\BibVerColecao();
            $this->Dados['dados_col'] = $verColecao->verColecao($this->DadosId);
            $this->Dados['qtCol'] = $verColecao->qtColecao();
            $this->Dados['contCol'] = $verColecao->contarColecao();

            $botao = ['list_col' => ['menu_controller' => 'colecao', 'menu_metodo' => 'listar'],
                'edit_col' => ['menu_controller' => 'editar-colecao', 'menu_metodo' => 'edit-colecao'],
                'del_col' => ['menu_controller' => 'apagar-colecao', 'menu_metodo' => 'apagar-colecao']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/colecao/verColecao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Colecao não encontrada!</div>";
            $UrlDestino = URLADM . 'colecao/listar';
            header("Location: $UrlDestino");
        }
    }

}
