<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaEnergia
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaEnergia();
            $this->Dados['dados_ene'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_ene' => ['menu_controller' => 'conta-energia', 'menu_metodo' => 'listar'],
                'edit_ene' => ['menu_controller' => 'editar-conta-energia', 'menu_metodo' => 'edit-conta'],
                'del_ene' => ['menu_controller' => 'apagar-conta-energia', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaEnergia", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaEnergia não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-energia/listar';
            header("Location: $UrlDestino");
        }
    }
}
