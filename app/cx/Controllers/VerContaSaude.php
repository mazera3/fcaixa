<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaSaude
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaSaude
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaSaude();
            $this->Dados['dados_sau'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_sau' => ['menu_controller' => 'conta-saude', 'menu_metodo' => 'listar'],
                'edit_sau' => ['menu_controller' => 'editar-conta-saude', 'menu_metodo' => 'edit-conta'],
                'del_sau' => ['menu_controller' => 'apagar-conta-saude', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaSaude", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaSaude não encontrada!</div>";
            $UrlDestino = URLADM . 'conta_saude/listar';
            header("Location: $UrlDestino");
        }
    }
}
