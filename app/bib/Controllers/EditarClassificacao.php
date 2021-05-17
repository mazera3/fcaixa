<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarClassificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarClassificacao
{

    private $Dados;
    private $DadosId;

    public function editClassificacao($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editClassificacaoPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Classificação não encontrada!</div>";
            $UrlDestino = URLADM . 'classificacao/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editClassificacaoPriv()
    {
        if (!empty($this->Dados['EditClass'])) {
            unset($this->Dados['EditClass']);
            
            $editarClassificacao = new \App\bib\Models\BibEditarClassificacao();
            $editarClassificacao->altClassificacao($this->Dados);
            if ($editarClassificacao->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Classificação editada com sucesso!</div>";
                $UrlDestino = URLADM . 'classificacao/listar/';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editClassificacaoViewPriv();
            }
        } else {
            $verClassificacao = new \App\bib\Models\BibEditarClassificacao();
            $this->Dados['form'] = $verClassificacao->verClassificacao($this->DadosId);
            $this->editClassificacaoViewPriv();
        }
    }

    private function editClassificacaoViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['list_class' => ['menu_controller' => 'classificacao', 'menu_metodo' => 'listar']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/classificacao/editarClassificacao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Classificação não encontrada!</div>";
            $UrlDestino = URLADM . 'classificacao/listar';
            header("Location: $UrlDestino");
        }
    }

}
