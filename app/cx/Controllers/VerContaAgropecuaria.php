<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaAgropecuaria
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaAgropecuaria
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaAgropecuaria();
            $this->Dados['dados_agr'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_agr' => ['menu_controller' => 'conta-agropecuaria', 'menu_metodo' => 'listar'],
                'edit_agr' => ['menu_controller' => 'editar-conta-agropecuaria', 'menu_metodo' => 'edit-conta'],
                'del_agr' => ['menu_controller' => 'apagar-conta-agropecuaria', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaAgropecuaria", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaAgropecuaria não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-agropecuaria/listar';
            header("Location: $UrlDestino");
        }
    }
}
