<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaConstrucao
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaConstrucao
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaConstrucao();
            $this->Dados['dados_con'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_con' => ['menu_controller' => 'conta-construcao', 'menu_metodo' => 'listar'],
                'edit_con' => ['menu_controller' => 'editar-conta-construcao', 'menu_metodo' => 'edit-conta'],
                'del_con' => ['menu_controller' => 'apagar-conta-construcao', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/extras/verContaConstrucao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaConstrucao não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-construcao/listar';
            header("Location: $UrlDestino");
        }
    }
}
