<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class VerEntrada
{

    private $Dados;
    private $DadosId;

    public function verEntrada($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verEntrada = new \App\cx\Models\CxVerEntrada();
            $this->Dados['dados_ent'] = $verEntrada->verEntrada($this->DadosId);

            $botao = [
                'list_ent' => ['menu_controller' => 'entrada', 'menu_metodo' => 'listar'],
                'edit_ent' => ['menu_controller' => 'editar-entrada', 'menu_metodo' => 'edit-entrada'],
                'del_ent' => ['menu_controller' => 'apagar-entrada', 'menu_metodo' => 'apagar-entrada']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/entrada/verEntrada", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Entrada não encontrada!</div>";
            $UrlDestino = URLADM . 'entrada/listar';
            header("Location: $UrlDestino");
        }
    }
}
