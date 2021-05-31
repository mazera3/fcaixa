<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerBiblioteca
 *
 * @copyright (c) year, Édio Mazera
 */
class VerBiblioteca {

    private $Dados;
    private $DadosId;

    public function verBiblioteca($DadosId = null) {

        $this->DadosId = (int) $DadosId;

        if (!empty($this->DadosId)) {
            $verBiblioteca = new \App\bib\Models\BibVerBiblioteca();
            $this->Dados['dados_biblioteca'] = $verBiblioteca->verBiblioteca($this->DadosId);

            $botao = [
                'list_biblioteca' => ['menu_controller' => 'listar-biblioteca', 'menu_metodo' => 'listar'],
                'edit_biblioteca' => ['menu_controller' => 'editar-biblioteca', 'menu_metodo' => 'edit-biblioteca'],
                'del_biblioteca' => ['menu_controller' => 'apagar-biblioteca', 'menu_metodo' => 'apagar-biblioteca']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $contBiblioteca = new \App\bib\Models\BibApagarBiblioteca();
            $this->Dados['contBiblioteca'] = $contBiblioteca->contaBibliotecaCad();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/verBiblioteca", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Biblioteca não encontrada!</div>";
            $UrlDestino = URLADM . 'listar-biblioteca/listar';
            header("Location: $UrlDestino");
        }
    }

}
