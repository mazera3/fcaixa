<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarAutor {

    private $Dados;
    private $DadosId;

    public function editAutor($DadosId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editAutorPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Autor não encontrado!</div>";
            $UrlDestino = URLADM . 'autores/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editAutorPriv() {
        if (!empty($this->Dados['EditAutor'])) {
            unset($this->Dados['EditAutor']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarAutor = new \App\bib\Models\BibEditarAutor();
            $editarAutor->altAutor($this->Dados);
            if ($editarAutor->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Autor editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-autor/ver-autor/' . $this->Dados['aut_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editAutorViewPriv();
            }
        } else {
            $verAutor = new \App\bib\Models\BibEditarAutor();
            $this->Dados['form'] = $verAutor->verAutor($this->DadosId);
            $this->editAutorViewPriv();
        }
    }

    private function editAutorViewPriv() {
        if ($this->Dados['form']) {

            $listarSelect = new \App\bib\Models\BibEditarAutor();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_aut' => ['menu_controller' => 'ver-autor', 'menu_metodo' => 'ver-autor']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/autor/editarAutor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Autor não encontrado!</div>";
            $UrlDestino = URLADM . 'autores/listar';
            header("Location: $UrlDestino");
        }
    }

}
