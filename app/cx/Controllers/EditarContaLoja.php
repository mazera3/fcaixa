<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarContaLoja
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarContaLoja
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
            $UrlDestino = URLADM . 'conta-loja/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editContaPriv()
    {
        if (!empty($this->Dados['EditLoj'])) {
            unset($this->Dados['EditLoj']);

            $editarConta = new \App\cx\Models\CxEditarContaLoja();
            $editarConta->altConta($this->Dados);
            if ($editarConta->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Conta editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-conta-loja/ver-conta/' . $this->Dados['id_loj'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editContaViewPriv();
            }
        } else {
            $verConta = new \App\cx\Models\CxEditarContaLoja();
            $this->Dados['form'] = $verConta->verConta($this->DadosId);
            $this->editContaViewPriv();
        }
    }

    private function editContaViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarContaLoja();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_loj' => ['menu_controller' => 'ver-conta-loja', 'menu_metodo' => 'ver-conta']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/editarContaLoja", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-loja/listar';
            header("Location: $UrlDestino");
        }
    }
}
