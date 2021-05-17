<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarStCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarStCopia {

    private $Dados;
    private $DadosId;

    public function editStCopia($DadosId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editStCopiaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrada!</div>";
            $UrlDestino = URLADM . 'situacoes/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editStCopiaPriv() {
        if (!empty($this->Dados['EditStCopia'])) {
            unset($this->Dados['EditStCopia']);

            $editarStCopia = new \App\bib\Models\BibEditarStCopia();
            $editarStCopia->altStCopia($this->Dados);
            if ($editarStCopia->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Situação editada com sucesso!</div>";
                $UrlDestino = URLADM . 'situacoes/listar/';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editStCopiaViewPriv();
            }
        } else {
            $verStCopia = new \App\bib\Models\BibEditarStCopia();
            $this->Dados['form'] = $verStCopia->verStCopia($this->DadosId);
            $this->editStCopiaViewPriv();
        }
    }

    private function editStCopiaViewPriv() {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarStCopia();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['list_sits' => ['menu_controller' => 'situacoes', 'menu_metodo' => 'listar']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/situacoes/editarStCopia", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrada!</div>";
            $UrlDestino = URLADM . 'situacoes/listar';
            header("Location: $UrlDestino");
        }
    }

}
