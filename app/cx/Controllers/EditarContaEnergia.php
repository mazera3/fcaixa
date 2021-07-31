<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarContaEnergia
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
            $UrlDestino = URLADM . 'conta-energia/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editContaPriv()
    {
        if (!empty($this->Dados['EditEne'])) {
            unset($this->Dados['EditEne']);

            $editarConta = new \App\cx\Models\CxEditarContaEnergia();
            $editarConta->altConta($this->Dados);
            if ($editarConta->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Conta editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-conta-energia/ver-conta/' . $this->Dados['id_ene'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editContaViewPriv();
            }
        } else {
            $verConta = new \App\cx\Models\CxEditarContaEnergia();
            $this->Dados['form'] = $verConta->verConta($this->DadosId);
            $this->editContaViewPriv();
        }
    }

    private function editContaViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarContaEnergia();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_ene' => ['menu_controller' => 'ver-conta-energia', 'menu_metodo' => 'ver-conta']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/editarContaEnergia", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-energia/listar';
            header("Location: $UrlDestino");
        }
    }
}
