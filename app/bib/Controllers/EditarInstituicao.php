<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarInstituicao
{

    private $Dados;
    private $DadosId;

    public function editInstituicao($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editInstituicaoPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Instituicao não encontrada!</div>";
            $UrlDestino = URLADM . 'instituicao/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editInstituicaoPriv()
    {
        if (!empty($this->Dados['EditInstituicao'])) {
            unset($this->Dados['EditInstituicao']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarInstituicao = new \App\bib\Models\BibEditarInstituicao();
            $editarInstituicao->altInstituicao($this->Dados);
            if ($editarInstituicao->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Instituicao editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-instituicao/ver-instituicao/' . $this->Dados['id_instituicao'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editInstituicaoViewPriv();
            }
        } else {
            $verInstituicao = new \App\bib\Models\BibEditarInstituicao();
            $this->Dados['form'] = $verInstituicao->verInstituicao($this->DadosId);
            $this->editInstituicaoViewPriv();
        }
    }

    private function editInstituicaoViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['vis_instituicao' => ['menu_controller' => 'ver-instituicao', 'menu_metodo' => 'ver-instituicao']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/editarInstituicao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Instituicao não encontrada!</div>";
            $UrlDestino = URLADM . 'instituicao/listar';
            header("Location: $UrlDestino");
        }
    }

}
