<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerAutor
 *
 * @copyright (c) year, Édio Mazera
 */
class VerAutor
{

    private $Dados;
    private $DadosId;

    public function verAutor($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        //$this->DadosId = 1;
        if (!empty($this->DadosId)) {
            $verAutor = new \App\bib\Models\BibVerAutor();
            $this->Dados['dados_autor'] = $verAutor->verAutor($this->DadosId);           
            
            $botao = ['list_autor' => ['menu_controller' => 'autores', 'menu_metodo' => 'listar'],
                'edit_autor' => ['menu_controller' => 'editar-autor', 'menu_metodo' => 'edit-autor'],
                'del_autor' => ['menu_controller' => 'apagar-autor', 'menu_metodo' => 'apagar-autor']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/autor/verAutor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Autor não encontrado!</div>";
            $UrlDestino = URLADM . 'autores/listar';
            header("Location: $UrlDestino");
        }
    }

}
