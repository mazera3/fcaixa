<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarCategoria
{

    private $Dados;
    private $DadosId;

    public function editCategoria($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editCategoriaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Categoria não encontrada!</div>";
            $UrlDestino = URLADM . 'categoria/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editCategoriaPriv()
    {
        if (!empty($this->Dados['EditCat'])) {
            unset($this->Dados['EditCat']);
            
            $editarCategoria = new \App\cx\Models\CxEditarCategoria();
            $editarCategoria->altCategoria($this->Dados);
            if ($editarCategoria->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Categoria editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-categoria/ver-categoria/' . $this->Dados['id_cat'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editCategoriaViewPriv();
            }
        } else {
            $verCategoria = new \App\cx\Models\CxEditarCategoria();
            $this->Dados['form'] = $verCategoria->verCategoria($this->DadosId);
            $this->editCategoriaViewPriv();
        }
    }

    private function editCategoriaViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['vis_cat' => ['menu_controller' => 'ver-categoria', 'menu_metodo' => 'ver-categoria']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\cx\core\ConfigView("cx/Views/categoria/editarCategoria", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Categoria não encontrada!</div>";
            $UrlDestino = URLADM . 'categoria/listar';
            header("Location: $UrlDestino");
        }
    }

}
