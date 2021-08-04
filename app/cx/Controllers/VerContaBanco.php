<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaBanco
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaBanco
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaBanco();
            $this->Dados['dados_ban'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_ban' => ['menu_controller' => 'conta-banco', 'menu_metodo' => 'listar'],
                'edit_ban' => ['menu_controller' => 'editar-conta-banco', 'menu_metodo' => 'edit-conta'],
                'del_ban' => ['menu_controller' => 'apagar-conta-banco', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/extras/verContaBanco", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaBanco não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-banco/listar';
            header("Location: $UrlDestino");
        }
    }
}
