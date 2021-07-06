<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarSaida
{

    private $Dados;
    private $DadosId;

    public function editSaida($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editSaidaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Saida não encontrada!</div>";
            $UrlDestino = URLADM . 'saida/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editSaidaPriv()
    {
        if (!empty($this->Dados['EditSai'])) {
            unset($this->Dados['EditSai']);

            $editarSaida = new \App\cx\Models\CxEditarSaida();
            $editarSaida->altSaida($this->Dados);
            if ($editarSaida->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Saida editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-saida/ver-saida/' . $this->Dados['id_sai'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editSaidaViewPriv();
            }
        } else {
            $verSaida = new \App\cx\Models\CxEditarSaida();
            $this->Dados['form'] = $verSaida->verSaida($this->DadosId);
            $this->editSaidaViewPriv();
        }
    }

    private function editSaidaViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarSaida();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_sai' => ['menu_controller' => 'ver-saida', 'menu_metodo' => 'ver-saida']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/saida/editarSaida", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Saida não encontrada!</div>";
            $UrlDestino = URLADM . 'saida/listar';
            header("Location: $UrlDestino");
        }
    }
}
