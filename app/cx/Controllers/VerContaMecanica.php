<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaMecanica
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaMecanica
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaMecanica();
            $this->Dados['dados_mec'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_mec' => ['menu_controller' => 'conta-mecanica', 'menu_metodo' => 'listar'],
                'edit_mec' => ['menu_controller' => 'editar-conta-mecanica', 'menu_metodo' => 'edit-conta'],
                'del_mec' => ['menu_controller' => 'apagar-conta-mecanica', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaMecanica", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaMecanica não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-mecanica/listar';
            header("Location: $UrlDestino");
        }
    }
}
