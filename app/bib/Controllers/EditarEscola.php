<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarEscola
{

    private $Dados;
    private $DadosId;

    public function editEscola($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editEscolaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Escola não encontrada!</div>";
            $UrlDestino = URLADM . 'escola/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editEscolaPriv()
    {
        if (!empty($this->Dados['EditEscola'])) {
            unset($this->Dados['EditEscola']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarEscola = new \App\bib\Models\BibEditarEscola();
            $editarEscola->altEscola($this->Dados);
            if ($editarEscola->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Escola editada com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-escola/ver-escola/' . $this->Dados['id_escola'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editEscolaViewPriv();
            }
        } else {
            $verEscola = new \App\bib\Models\BibEditarEscola();
            $this->Dados['form'] = $verEscola->verEscola($this->DadosId);
            $this->editEscolaViewPriv();
        }
    }

    private function editEscolaViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['vis_escola' => ['menu_controller' => 'ver-escola', 'menu_metodo' => 'ver-escola']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/escola/editarEscola", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Escola não encontrada!</div>";
            $UrlDestino = URLADM . 'escola/listar';
            header("Location: $UrlDestino");
        }
    }

}
