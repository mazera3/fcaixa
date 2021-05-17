<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarLeitor
{

    private $Dados;
    private $DadosId;

    public function editLeitor($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editLeitorPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Leitor não encontrado!</div>";
            $UrlDestino = URLADM . 'leitores/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editLeitorPriv()
    {
        if (!empty($this->Dados['EditLeitor'])) {
            unset($this->Dados['EditLeitor']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarLeitor = new \App\bib\Models\BibEditarLeitor();
            $editarLeitor->altLeitor($this->Dados);
            if ($editarLeitor->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Leitor editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-leitor/ver-leitor/' . $this->Dados['leitor_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editLeitorViewPriv();
            }
        } else {
            $verLeitor = new \App\bib\Models\BibEditarLeitor();
            $this->Dados['form'] = $verLeitor->verLeitor($this->DadosId);
            $this->editLeitorViewPriv();
        }
    }

    private function editLeitorViewPriv()
    {
        if ($this->Dados['form']) {
            
            $listarSelect = new \App\bib\Models\BibEditarLeitor();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_leitor' => ['menu_controller' => 'ver-leitor', 'menu_metodo' => 'ver-leitor']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/leitor/editarLeitor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Leitor não encontrado!</div>";
            $UrlDestino = URLADM . 'leitores/listar';
            header("Location: $UrlDestino");
        }
    }

}
