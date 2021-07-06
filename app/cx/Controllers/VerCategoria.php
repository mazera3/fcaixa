<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class VerCategoria
{

    private $Dados;
    private $DadosId;

    public function verCategoria($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verCategoria = new \App\cx\Models\CxVerCategoria();
            $this->Dados['dados_cat'] = $verCategoria->verCategoria($this->DadosId);

            $botao = [
                'list_cat' => ['menu_controller' => 'Categoria', 'menu_metodo' => 'listar'],
                'edit_cat' => ['menu_controller' => 'editar-Categoria', 'menu_metodo' => 'edit-Categoria'],
                'del_cat' => ['menu_controller' => 'apagar-Categoria', 'menu_metodo' => 'apagar-Categoria']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cx\core\ConfigView("cx/Views/categoria/verCategoria", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Categoria não encontrada!</div>";
            $UrlDestino = URLADM . 'categoria/listar';
            header("Location: $UrlDestino");
        }
    }
}
