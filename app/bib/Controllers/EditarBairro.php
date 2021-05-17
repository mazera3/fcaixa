<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarBairro
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarBairro
{

    private $Dados;
    private $DadosId;

    public function editBairro($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editBairroPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bairro não encontrado!</div>";
            $UrlDestino = URLADM . 'bairros/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editBairroPriv()
    {
        if (!empty($this->Dados['EditBairro'])) {
            unset($this->Dados['EditBairro']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarBairro = new \App\bib\Models\BibEditarBairro();
            $editarBairro->altBairro($this->Dados);
            if ($editarBairro->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Bairro editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-bairro/ver-bairro/' . $this->Dados['br_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editBairroViewPriv();
            }
        } else {
            $verBairro = new \App\bib\Models\BibEditarBairro();
            $this->Dados['form'] = $verBairro->verBairro($this->DadosId);
            $this->editBairroViewPriv();
        }
    }

    private function editBairroViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarBairro();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_br' => ['menu_controller' => 'ver-bairro', 'menu_metodo' => 'ver-bairro']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/bairro/editarBairro", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bairro não encontrado!</div>";
            $UrlDestino = URLADM . 'bairros/listar';
            header("Location: $UrlDestino");
        }
    }

}
