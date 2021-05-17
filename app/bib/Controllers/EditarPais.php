<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarPais
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarPais
{

    private $Dados;
    private $DadosId;

    public function editPais($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editPaisPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Pais não encontrado!</div>";
            $UrlDestino = URLADM . 'pais/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editPaisPriv()
    {
        if (!empty($this->Dados['EditPais'])) {
            unset($this->Dados['EditPais']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarPais = new \App\bib\Models\BibEditarPais();
            $editarPais->altPais($this->Dados);
            if ($editarPais->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Pais editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-pais/ver-pais/' . $this->Dados['pais_id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editPaisViewPriv();
            }
        } else {
            $verPais = new \App\bib\Models\BibEditarPais();
            $this->Dados['form'] = $verPais->verPais($this->DadosId);
            $this->editPaisViewPriv();
        }
    }

    private function editPaisViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['vis_pais' => ['menu_controller' => 'ver-pais', 'menu_metodo' => 'ver-pais']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\bib\core\ConfigView("bib/Views/pais/editarPais", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Pais não encontrado!</div>";
            $UrlDestino = URLADM . 'pais/listar';
            header("Location: $UrlDestino");
        }
    }

}
