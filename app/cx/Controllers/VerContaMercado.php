<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaMercado
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaMercado
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaMercado();
            $this->Dados['dados_mer'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_mer' => ['menu_controller' => 'conta-mercado', 'menu_metodo' => 'listar'],
                'edit_mer' => ['menu_controller' => 'editar-conta-mercado', 'menu_metodo' => 'edit-conta'],
                'del_mer' => ['menu_controller' => 'apagar-conta-mercado', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaMercado", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaMercado não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-mercado/listar';
            header("Location: $UrlDestino");
        }
    }
}
