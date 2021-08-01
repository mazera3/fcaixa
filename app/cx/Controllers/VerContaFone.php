<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerContaFone
 *
 * @copyright (c) year, Édio Mazera
 */
class VerContaFone
{

    private $Dados;
    private $DadosId;

    public function verConta($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verConta = new \App\cx\Models\CxVerContaFone();
            $this->Dados['dados_fon'] = $verConta->verConta($this->DadosId);

            $botao = [
                'list_fon' => ['menu_controller' => 'conta-fone', 'menu_metodo' => 'listar'],
                'edit_fon' => ['menu_controller' => 'editar-conta-fone', 'menu_metodo' => 'edit-conta'],
                'del_fon' => ['menu_controller' => 'apagar-conta-fone', 'menu_metodo' => 'apagar-conta']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/verContaFone", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: ContaFone não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-fone/listar';
            header("Location: $UrlDestino");
        }
    }
}
