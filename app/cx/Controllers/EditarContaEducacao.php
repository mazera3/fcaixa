<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarContaEducacao
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarContaEducacao
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
            $UrlDestino = URLADM . 'conta-educacao/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editContaPriv()
    {
        if (!empty($this->Dados['EditEdu'])) {
            unset($this->Dados['EditEdu']);

            $editarConta = new \App\cx\Models\CxEditarContaEducacao();
            $editarConta->altConta($this->Dados);
            if ($editarConta->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Conta editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-conta-educacao/ver-conta/' . $this->Dados['id_edu'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editContaViewPriv();
            }
        } else {
            $verConta = new \App\cx\Models\CxEditarContaEducacao();
            $this->Dados['form'] = $verConta->verConta($this->DadosId);
            $this->editContaViewPriv();
        }
    }

    private function editContaViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarContaEducacao();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_edu' => ['menu_controller' => 'ver-conta-educacao', 'menu_metodo' => 'ver-conta']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/editarContaEducacao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-educacao/listar';
            header("Location: $UrlDestino");
        }
    }
}
