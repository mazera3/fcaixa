<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of EditarCatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarCatImovel
{

    private $Dados;
    private $DadosId;

    public function editCatImovel($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editCatImovelPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: CatImovel não encontrada!</div>";
            $UrlDestino = URLADM . 'cat-imovel/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editCatImovelPriv()
    {
        if (!empty($this->Dados['EditImv'])) {
            unset($this->Dados['EditImv']);
            
            $editarCatImovel = new \App\cx\Models\CxEditarCatImovel();
            $editarCatImovel->altCatImovel($this->Dados);
            if ($editarCatImovel->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>CatImovel editada com sucesso!</div>";
                //$UrlDestino = URLADM . 'ver-cat-imovel/ver-cat-imovel/' . $this->Dados['id_imv'];
                $UrlDestino = URLADM . 'cat-imovel/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editCatImovelViewPriv();
            }
        } else {
            $verCatImovel = new \App\cx\Models\CxEditarCatImovel();
            $this->Dados['form'] = $verCatImovel->verCatImovel($this->DadosId);
            $this->editCatImovelViewPriv();
        }
    }

    private function editCatImovelViewPriv()
    {
        if ($this->Dados['form']) {
            
            $botao = ['vis_imv' => ['menu_controller' => 'ver-cat-imovel', 'menu_metodo' => 'ver-cat-imovel']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $carregarView = new \App\cx\core\ConfigView("cx/Views/patrimonio/editarCatImovel", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: CatImovel não encontrada!</div>";
            $UrlDestino = URLADM . 'cat-imovel/listar';
            header("Location: $UrlDestino");
        }
    }

}
