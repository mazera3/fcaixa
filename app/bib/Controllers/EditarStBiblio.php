<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarStBiblio
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarStBiblio {

    private $Dados;
    private $DadosId;

    public function editStBiblio($DadosId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editStBiblioPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrada!</div>";
            $UrlDestino = URLADM . 'situacoes/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editStBiblioPriv() {
        if (!empty($this->Dados['EditStBiblio'])) {
            unset($this->Dados['EditStBiblio']);

            $editarStBiblio = new \App\bib\Models\BibEditarStBiblio();
            $editarStBiblio->altStBiblio($this->Dados);
            if ($editarStBiblio->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Situação editada com sucesso!</div>";
                $UrlDestino = URLADM . 'situacoes/listar/';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editStBiblioViewPriv();
            }
        } else {
            $verStBiblio = new \App\bib\Models\BibEditarStBiblio();
            $this->Dados['form'] = $verStBiblio->verStBiblio($this->DadosId);
            $this->editStBiblioViewPriv();
        }
    }

    private function editStBiblioViewPriv() {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarStBiblio();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['list_sits' => ['menu_controller' => 'situacoes', 'menu_metodo' => 'listar']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/situacoes/editarStBiblio", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrada!</div>";
            $UrlDestino = URLADM . 'situacoes/listar';
            header("Location: $UrlDestino");
        }
    }

}
