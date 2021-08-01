<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaLoja
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaLoja
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaLoja();
            $this->Dados['dados_loj'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_loj' => ['menu_controller' => 'conta-loja', 'menu_metodo' => 'listar'],
                'edit_loj' => ['menu_controller' => 'editar-conta-loja', 'menu_metodo' => 'edit-conta'],
                'del_loj' => ['menu_controller' => 'apagar-conta-loja', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaLoja", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaLoja não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-loja/listar';
            header("Location: $UrlDestino");
        }
    }
}
