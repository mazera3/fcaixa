<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class VerSaida
{

    private $Dados;
    private $DadosId;

    public function verSaida($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verSaida = new \App\cx\Models\CxVerSaida();
            $this->Dados['dados_sai'] = $verSaida->verSaida($this->DadosId);

            $botao = [
                'list_sai' => ['menu_controller' => 'saida', 'menu_metodo' => 'listar'],
                'edit_sai' => ['menu_controller' => 'editar-saida', 'menu_metodo' => 'edit-saida'],
                'del_sai' => ['menu_controller' => 'apagar-saida', 'menu_metodo' => 'apagar-saida']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/saida/verSaida", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Saida não encontrada!</div>";
            $UrlDestino = URLADM . 'saida/listar';
            header("Location: $UrlDestino");
        }
    }
}
