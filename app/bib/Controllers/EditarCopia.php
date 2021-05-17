<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarCopia
{

    private $Dados;
    private $DadosId;

    public function editCopia($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editCopiaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cópia não encontrada!</div>";
            $UrlDestino = URLADM . 'copias/listar/';
            //$UrlDestino = URLADM . 'ver-copia/ver-copia/' . $this->Dados['cop_id'];
            header("Location: $UrlDestino");
        }
    }

    private function editCopiaPriv()
    {
        if (!empty($this->Dados['EditCopia'])) {
            unset($this->Dados['EditCopia']);
            
            $editarCopia = new \App\bib\Models\BibEditarCopia();
            $editarCopia->altCopia($this->Dados);
            if ($editarCopia->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Cópia editada com sucesso!</div>";
                $UrlDestino = URLADM . 'copias/listar/';
                //$UrlDestino = URLADM . 'ver-copia/ver-copia/' . $this->Dados['cop_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editCopiaViewPriv();
            }
        } else {
            $verCopia = new \App\bib\Models\BibEditarCopia();
            $this->Dados['form'] = $verCopia->verCopia($this->DadosId);
            $this->editCopiaViewPriv();
        }
    }

    private function editCopiaViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarCopia();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['list_copia' => ['menu_controller' => 'copias', 'menu_metodo' => 'listar']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/copia/editarCopia", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cópia não encontrada!</div>";
            $UrlDestino = URLADM . 'copias/listar';
            header("Location: $UrlDestino");
        }
    }

}
