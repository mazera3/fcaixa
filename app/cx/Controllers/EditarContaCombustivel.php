<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarContaCombustivel
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarContaCombustivel
{

    private $Dados;
    private $DadosId;

    public function editConta($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editContaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-combustivel/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editContaPriv()
    {
        if (!empty($this->Dados['EditComb'])) {
            unset($this->Dados['EditComb']);

            $editarConta = new \App\cx\Models\CxEditarContaCombustivel();
            $editarConta->altConta($this->Dados);
            if ($editarConta->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Conta editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-conta-combustivel/ver-conta/' . $this->Dados['id_comb'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editContaViewPriv();
            }
        } else {
            $verConta = new \App\cx\Models\CxEditarContaCombustivel();
            $this->Dados['form'] = $verConta->verConta($this->DadosId);
            $this->editContaViewPriv();
        }
    }

    private function editContaViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarContaCombustivel();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_comb' => ['menu_controller' => 'ver-conta-combustivel', 'menu_metodo' => 'ver-conta']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/editarContaCombustivel", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-combustivel/listar';
            header("Location: $UrlDestino");
        }
    }
}
