<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarStLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarStLeitor {

    private $Dados;
    private $DadosId;

    public function editStLeitor($DadosId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editStLeitorPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrada!</div>";
            $UrlDestino = URLADM . 'situacoes/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editStLeitorPriv() {
        if (!empty($this->Dados['EditStLeitor'])) {
            unset($this->Dados['EditStLeitor']);

            $editarStLeitor = new \App\bib\Models\BibEditarStLeitor();
            $editarStLeitor->altStLeitor($this->Dados);
            if ($editarStLeitor->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Situação editada com sucesso!</div>";
                $UrlDestino = URLADM . 'situacoes/listar/';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editStLeitorViewPriv();
            }
        } else {
            $verStLeitor = new \App\bib\Models\BibEditarStLeitor();
            $this->Dados['form'] = $verStLeitor->verStLeitor($this->DadosId);
            $this->editStLeitorViewPriv();
        }
    }

    private function editStLeitorViewPriv() {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarStLeitor();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['list_sits' => ['menu_controller' => 'situacoes', 'menu_metodo' => 'listar']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/situacoes/editarStLeitor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrada!</div>";
            $UrlDestino = URLADM . 'situacoes/listar';
            header("Location: $UrlDestino");
        }
    }

}
