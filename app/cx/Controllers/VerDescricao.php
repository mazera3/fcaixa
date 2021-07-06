<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class VerDescricao
{

    private $Dados;
    private $DadosId;

    public function verDescricao($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verDescricao = new \App\cx\Models\CxVerDescricao();
            $this->Dados['dados_des'] = $verDescricao->verDescricao($this->DadosId);

            $botao = [
                'list_des' => ['menu_controller' => 'descricao', 'menu_metodo' => 'listar'],
                'edit_des' => ['menu_controller' => 'editar-descricao', 'menu_metodo' => 'edit-descricao'],
                'del_des' => ['menu_controller' => 'apagar-descricao', 'menu_metodo' => 'apagar-descricao']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/descricao/verDescricao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Descricao não encontrada!</div>";
            $UrlDestino = URLADM . 'descricao/listar';
            header("Location: $UrlDestino");
        }
    }
}
