<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarSaldo
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarSaldo
{

    private $Dados;
    private $DadosId;

    public function editSaldo($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editSaldoPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Saldo não encontrado!</div>";
            $UrlDestino = URLADM . 'saldo/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editSaldoPriv()
    {
        if (!empty($this->Dados['EditSal'])) {
            unset($this->Dados['EditSal']);

            $editarSaldo = new \App\cx\Models\CxEditarSaldo();
            $editarSaldo->altSaldo($this->Dados);
            if ($editarSaldo->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Saldo editado com sucesso!</div>";
                $UrlDestino = URLADM . 'saldo/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editSaldoViewPriv();
            }
        } else {
            $verSaldo = new \App\cx\Models\CxEditarSaldo();
            $this->Dados['form'] = $verSaldo->verSaldo($this->DadosId);
            $this->editSaldoViewPriv();
        }
    }

    private function editSaldoViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarSaldo();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['list_sal' => ['menu_controller' => 'saldo', 'menu_metodo' => 'listar']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/saldo/editarSaldo", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Saldo não encontrado!</div>";
            $UrlDestino = URLADM . 'saldo/listar';
            header("Location: $UrlDestino");
        }
    }
}
