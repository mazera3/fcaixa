<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarColecao
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarColecao
{

    private $Dados;
    private $DadosId;

    public function editColecao($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editColecaoPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Colecao não encontrada!</div>";
            $UrlDestino = URLADM . 'colecao/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editColecaoPriv()
    {
        if (!empty($this->Dados['EditColecao'])) {
            unset($this->Dados['EditColecao']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarColecao = new \App\bib\Models\BibEditarColecao();
            $editarColecao->altColecao($this->Dados);
            if ($editarColecao->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Colecao editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-colecao/ver-colecao/' . $this->Dados['col_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editColecaoViewPriv();
            }
        } else {
            $verColecao = new \App\bib\Models\BibEditarColecao();
            $this->Dados['form'] = $verColecao->verColecao($this->DadosId);
            $this->editColecaoViewPriv();
        }
    }

    private function editColecaoViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['vis_col' => ['menu_controller' => 'ver-colecao', 'menu_metodo' => 'ver-colecao']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/colecao/editarColecao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Colecao não encontrada!</div>";
            $UrlDestino = URLADM . 'colecao/listar';
            header("Location: $UrlDestino");
        }
    }

}
