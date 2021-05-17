<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarBibliografia
{

    private $Dados;
    private $DadosId;

    public function editBibliografia($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editBibliografiaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bibliografia não encontrada!</div>";
            $UrlDestino = URLADM . 'bibliografias/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editBibliografiaPriv()
    {
        if (!empty($this->Dados['EditBibliografia'])) {
            unset($this->Dados['EditBibliografia']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarBibliografia = new \App\bib\Models\BibEditarBibliografia();
            $editarBibliografia->altBibliografia($this->Dados);
            if ($editarBibliografia->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Bibliografia editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-bibliografia/ver-bibliografia/' . $this->Dados['bib_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editBibliografiaViewPriv();
            }
        } else {
            $verBibliografia = new \App\bib\Models\BibEditarBibliografia();
            $this->Dados['form'] = $verBibliografia->verBibliografia($this->DadosId);
            $this->editBibliografiaViewPriv();
        }
    }

    private function editBibliografiaViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarBibliografia();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_bib' => ['menu_controller' => 'ver-bibliografia', 'menu_metodo' => 'ver-bibliografia']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/bibliografia/editarBibliografia", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bibliografia não encontrada!!</div>";
            $UrlDestino = URLADM . 'bibliografias/listar';
            header("Location: $UrlDestino");
        }
    }

}
