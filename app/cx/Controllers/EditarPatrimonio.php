<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarPatrimonio
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarPatrimonio
{

    private $Dados;
    private $DadosId;

    public function editPatrimonio($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editPatrimonioPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Patrimonio não encontrado!</div>";
            $UrlDestino = URLADM . 'patrimonio/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editPatrimonioPriv()
    {
        if (!empty($this->Dados['EditPat'])) {
            unset($this->Dados['EditPat']);

            $editarPatrimonio = new \App\cx\Models\CxEditarPatrimonio();
            $editarPatrimonio->altPatrimonio($this->Dados);
            if ($editarPatrimonio->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Patrimonio editado com sucesso!</div>";
                //$UrlDestino = URLADM . 'ver-patrimonio/ver-patrimonio/' . $this->Dados['id_pat'];
                $UrlDestino = URLADM . 'patrimonio/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editPatrimonioViewPriv();
            }
        } else {
            $verPatrimonio = new \App\cx\Models\CxEditarPatrimonio();
            $this->Dados['form'] = $verPatrimonio->verPatrimonio($this->DadosId);
            $this->editPatrimonioViewPriv();
        }
    }

    private function editPatrimonioViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\cx\Models\CxEditarPatrimonio();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_pat' => ['menu_controller' => 'ver-patrimonio', 'menu_metodo' => 'ver-patrimonio']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/patrimonio/editarPatrimonio", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Patrimonio não encontrado!</div>";
            $UrlDestino = URLADM . 'patrimonio/listar';
            header("Location: $UrlDestino");
        }
    }
}
