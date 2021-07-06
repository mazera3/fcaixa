<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarDescricao
{

    private $Dados;
    private $DadosId;

    public function editDescricao($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editDescricaoPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Descricao não encontrada!</div>";
            $UrlDestino = URLADM . 'descricao/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editDescricaoPriv()
    {
        if (!empty($this->Dados['EditDes'])) {
            unset($this->Dados['EditDes']);

            $editarDescricao = new \App\cx\Models\CxEditarDescricao();
            $editarDescricao->altDescricao($this->Dados);
            if ($editarDescricao->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Descricao editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-descricao/ver-descricao/' . $this->Dados['id_des'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editDescricaoViewPriv();
            }
        } else {
            $verDescricao = new \App\cx\Models\CxEditarDescricao();
            $this->Dados['form'] = $verDescricao->verDescricao($this->DadosId);
            $this->editDescricaoViewPriv();
        }
    }

    private function editDescricaoViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarDescricao();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_des' => ['menu_controller' => 'ver-descricao', 'menu_metodo' => 'ver-descricao']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/descricao/editarDescricao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Descricao não encontrada!</div>";
            $UrlDestino = URLADM . 'descricao/listar';
            header("Location: $UrlDestino");
        }
    }
}
