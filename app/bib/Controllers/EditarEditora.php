<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarEditora
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarEditora
{

    private $Dados;
    private $DadosId;

    public function editEditora($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editEditoraPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Editora não encontrada!</div>";
            $UrlDestino = URLADM . 'editoras/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editEditoraPriv()
    {
        if (!empty($this->Dados['EditEditora'])) {
            unset($this->Dados['EditEditora']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarEditora = new \App\bib\Models\BibEditarEditora();
            $editarEditora->altEditora($this->Dados);
            if ($editarEditora->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Editora editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-editora/ver-editora/' . $this->Dados['ed_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editEditoraViewPriv();
            }
        } else {
            $verEditora = new \App\bib\Models\BibEditarEditora();
            $this->Dados['form'] = $verEditora->verEditora($this->DadosId);
            $this->editEditoraViewPriv();
        }
    }

    private function editEditoraViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarEditora();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_edi' => ['menu_controller' => 'ver-editora', 'menu_metodo' => 'ver-editora']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/editora/editarEditora", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Editora não encontrada!!</div>";
            $UrlDestino = URLADM . 'editoras/listar';
            header("Location: $UrlDestino");
        }
    }

}
