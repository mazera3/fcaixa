<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarMaterial
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarMaterial
{

    private $Dados;
    private $DadosId;

    public function editMaterial($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editMaterialPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Material não encontrado!</div>";
            $UrlDestino = URLADM . 'material/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editMaterialPriv()
    {
        if (!empty($this->Dados['EditMaterial'])) {
            unset($this->Dados['EditMaterial']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarMaterial = new \App\bib\Models\BibEditarMaterial();
            $editarMaterial->altMaterial($this->Dados);
            if ($editarMaterial->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Material editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-material/ver-material/' . $this->Dados['cod_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editMaterialViewPriv();
            }
        } else {
            $verMaterial = new \App\bib\Models\BibEditarMaterial();
            $this->Dados['form'] = $verMaterial->verMaterial($this->DadosId);
            $this->editMaterialViewPriv();
        }
    }

    private function editMaterialViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['vis_mat' => ['menu_controller' => 'ver-material', 'menu_metodo' => 'ver-material']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/material/editarMaterial", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Material não encontrado!</div>";
            $UrlDestino = URLADM . 'material/listar';
            header("Location: $UrlDestino");
        }
    }

}
