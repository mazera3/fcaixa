<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaSocial
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaSocial
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaSocial();
            $this->Dados['dados_soc'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_soc' => ['menu_controller' => 'conta-social', 'menu_metodo' => 'listar'],
                'edit_soc' => ['menu_controller' => 'editar-conta-social', 'menu_metodo' => 'edit-conta'],
                'del_soc' => ['menu_controller' => 'apagar-conta-social', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/extras/verContaSocial", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaSocial não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-social/listar';
            header("Location: $UrlDestino");
        }
    }
}
