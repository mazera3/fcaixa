<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaInformatica
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaInformatica
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaInformatica();
            $this->Dados['dados_inf'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_inf' => ['menu_controller' => 'conta-informatica', 'menu_metodo' => 'listar'],
                'edit_inf' => ['menu_controller' => 'editar-conta-informatica', 'menu_metodo' => 'edit-conta'],
                'del_inf' => ['menu_controller' => 'apagar-conta-informatica', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaInformatica", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaInformatica não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-informatica/listar';
            header("Location: $UrlDestino");
        }
    }
}
