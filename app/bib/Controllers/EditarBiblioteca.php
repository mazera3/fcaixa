<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarBiblioteca
{

    private $Dados;
    private $DadosId;

    public function editBiblioteca($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editBibliotecaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Biblioteca não encontrada!</div>";
            $UrlDestino = URLADM . 'listar-biblioteca/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editBibliotecaPriv()
    {
        if (!empty($this->Dados['EditBiblioteca'])) {
            unset($this->Dados['EditBiblioteca']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarBiblioteca = new \App\bib\Models\BibEditarBiblioteca();
            $editarBiblioteca->altBiblioteca($this->Dados);
            if ($editarBiblioteca->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Biblioteca editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-biblioteca/ver-biblioteca/' . $this->Dados['id_biblioteca'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editBibliotecaViewPriv();
            }
        } else {
            $verBiblioteca = new \App\bib\Models\BibEditarBiblioteca();
            $this->Dados['form'] = $verBiblioteca->verBiblioteca($this->DadosId);
            $this->editBibliotecaViewPriv();
        }
    }

    private function editBibliotecaViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarBiblioteca();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_biblioteca' => ['menu_controller' => 'ver-biblioteca', 'menu_metodo' => 'ver-biblioteca']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/editarBiblioteca", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Biblioteca não encontrada!</div>";
            $UrlDestino = URLADM . 'listar-biblioteca/listar';
            header("Location: $UrlDestino");
        }
    }

}
