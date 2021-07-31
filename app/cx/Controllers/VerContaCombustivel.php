<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaCombustivel
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaCombustivel
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaCombustivel();
            $this->Dados['dados_comb'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_comb' => ['menu_controller' => 'conta-combustivel', 'menu_metodo' => 'listar'],
                'edit_comb' => ['menu_controller' => 'editar-conta-combustivel', 'menu_metodo' => 'edit-conta'],
                'del_comb' => ['menu_controller' => 'apagar-conta-combustivel', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaCombustivel", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaCombustivel não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-combustivel/listar';
            header("Location: $UrlDestino");
        }
    }
}
