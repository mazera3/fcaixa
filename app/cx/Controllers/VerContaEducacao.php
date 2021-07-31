<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaEducacao
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaEducacao
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaEducacao();
            $this->Dados['dados_edu'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_edu' => ['menu_controller' => 'conta-educacao', 'menu_metodo' => 'listar'],
                'edit_edu' => ['menu_controller' => 'editar-conta-educacao', 'menu_metodo' => 'edit-conta'],
                'del_edu' => ['menu_controller' => 'apagar-conta-educacao', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaEducacao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaEducacao não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-educacao/listar';
            header("Location: $UrlDestino");
        }
    }
}
