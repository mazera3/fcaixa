<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarEntrada
{

    private $Dados;
    private $DadosId;

    public function editEntrada($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editEntradaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Entrada não encontrada!</div>";
            $UrlDestino = URLADM . 'entrada/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editEntradaPriv()
    {
        if (!empty($this->Dados['EditEnt'])) {
            unset($this->Dados['EditEnt']);

            $editarEntrada = new \App\cx\Models\CxEditarEntrada();
            $editarEntrada->altEntrada($this->Dados);
            if ($editarEntrada->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Entrada editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-entrada/ver-entrada/' . $this->Dados['id_ent'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editEntradaViewPriv();
            }
        } else {
            $verEntrada = new \App\cx\Models\CxEditarEntrada();
            $this->Dados['form'] = $verEntrada->verEntrada($this->DadosId);
            $this->editEntradaViewPriv();
        }
    }

    private function editEntradaViewPriv()
    {
        if ($this->Dados['form']) {

            $listarSelect = new \App\cx\Models\CxCadastrarEntrada();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_ent' => ['menu_controller' => 'ver-entrada', 'menu_metodo' => 'ver-entrada']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/entrada/editarEntrada", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Entrada não encontrada!</div>";
            $UrlDestino = URLADM . 'entrada/listar';
            header("Location: $UrlDestino");
        }
    }
}
