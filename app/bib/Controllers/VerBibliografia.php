<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class VerBibliografia {

    private $Dados;
    private $DadosId;

    public function verBibliografia($DadosId = null) {

        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verBiblio = new \App\bib\Models\BibVerBiblio();
            $this->Dados['dados_biblio'] = $verBiblio->verBiblio($this->DadosId);
            $this->Dados['verCopia'] = $verBiblio->verCopia($this->DadosId);
            $this->Dados['qtBiblio'] = $verBiblio->qtBiblio();
            $this->Dados['contCopia'] = $verBiblio->contarCopia();

            $botao = [
                'list_bibliografia' => ['menu_controller' => 'bibliografias', 'menu_metodo' => 'listar'],
                'edit_bibliografia' => ['menu_controller' => 'editar-bibliografia', 'menu_metodo' => 'edit-bibliografia'],
                'del_bibliografia' => ['menu_controller' => 'apagar-bibliografia', 'menu_metodo' => 'apagar-bibliografia'],
                'cad_copia' => ['menu_controller' => 'cadastrar-copia','menu_metodo' => 'cad-copia'],
                'list_copia' => ['menu_controller' => 'copias', 'menu_metodo' => 'listar'],
                'edit_copia' => ['menu_controller' => 'editar-copia', 'menu_metodo' => 'edit-copia'],
                'del_copia' => ['menu_controller' => 'apagar-copia', 'menu_metodo' => 'apagar-copia']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/bibliografia/verBibliografia", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Bibliografia não encontrada!!!</div>";
            $UrlDestino = URLADM . 'bibliografias/listar';
            header("Location: $UrlDestino");
        }
    }

}
