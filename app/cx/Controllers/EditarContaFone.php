<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarContaFone
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarContaFone
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
            $UrlDestino = URLADM . 'conta-fone/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editContaPriv()
    {
        if (!empty($this->Dados['EditFon'])) {
            unset($this->Dados['EditFon']);

            $editarConta = new \App\cx\Models\CxEditarContaFone();
            $editarConta->altConta($this->Dados);
            if ($editarConta->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Conta editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-conta-fone/ver-conta/' . $this->Dados['id_fon'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editContaViewPriv();
            }
        } else {
            $verConta = new \App\cx\Models\CxEditarContaFone();
            $this->Dados['form'] = $verConta->verConta($this->DadosId);
            $this->editContaViewPriv();
        }
    }

    private function editContaViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarContaFone();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_fon' => ['menu_controller' => 'ver-conta-fone', 'menu_metodo' => 'ver-conta']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/editarContaFone", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não encontrada!</div>";
            $UrlDestino = URLADM . 'conta-fone/listar';
            header("Location: $UrlDestino");
        }
    }
}
