<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarMunicipio
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarMunicipio
{

    private $Dados;
    private $DadosId;

    public function editMunicipio($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editMunicipioPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Municipio não encontrado!</div>";
            $UrlDestino = URLADM . 'municipio/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editMunicipioPriv()
    {
        if (!empty($this->Dados['EditMunicipio'])) {
            unset($this->Dados['EditMunicipio']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarMunicipio = new \App\bib\Models\BibEditarMunicipio();
            $editarMunicipio->altMunicipio($this->Dados);
            if ($editarMunicipio->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Municipio editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-municipio/ver-municipio/' . $this->Dados['mun_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editMunicipioViewPriv();
            }
        } else {
            $verMunicipio = new \App\bib\Models\BibEditarMunicipio();
            $this->Dados['form'] = $verMunicipio->verMunicipio($this->DadosId);
            $this->editMunicipioViewPriv();
        }
    }

    private function editMunicipioViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarMunicipio();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_mun' => ['menu_controller' => 'ver-municipio', 'menu_metodo' => 'ver-municipio']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/municipio/editarMunicipio", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Municipio não encontrado!</div>";
            $UrlDestino = URLADM . 'municipio/listar';
            header("Location: $UrlDestino");
        }
    }

}
