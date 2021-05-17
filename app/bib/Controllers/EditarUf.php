<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarUf
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarUf
{

    private $Dados;
    private $DadosId;

    public function editUf($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editUfPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Estado não encontrado!</div>";
            $UrlDestino = URLADM . 'uf/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editUfPriv()
    {
        if (!empty($this->Dados['EditUf'])) {
            unset($this->Dados['EditUf']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarUf = new \App\bib\Models\BibEditarUf();
            $editarUf->altUf($this->Dados);
            if ($editarUf->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Estado editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-uf/ver-uf/' . $this->Dados['uf_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editUfViewPriv();
            }
        } else {
            $verUf = new \App\bib\Models\BibEditarUf();
            $this->Dados['form'] = $verUf->verUf($this->DadosId);
            $this->editUfViewPriv();
        }
    }

    private function editUfViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarUf();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_uf' => ['menu_controller' => 'ver-uf', 'menu_metodo' => 'ver-uf']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/uf/editarUf", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Estado não encontrado!</div>";
            $UrlDestino = URLADM . 'uf/listar';
            header("Location: $UrlDestino");
        }
    }

}
