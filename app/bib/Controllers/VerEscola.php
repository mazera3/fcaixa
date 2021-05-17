<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerEscola
 *
 * @copyright (c) year, Édio Mazera
 */
class VerEscola {

    private $Dados;
    private $DadosId;

    public function verEscola($DadosId = null) {

        $this->DadosId = (int) $DadosId;

        if (!empty($this->DadosId)) {
            $verEscola = new \App\bib\Models\BibVerEscola();
            $this->Dados['dados_escola'] = $verEscola->verEscola($this->DadosId);

            $botao = [
                'list_escola' => ['menu_controller' => 'escola', 'menu_metodo' => 'listar'],
                'edit_escola' => ['menu_controller' => 'editar-escola', 'menu_metodo' => 'edit-escola'],
                'del_escola' => ['menu_controller' => 'apagar-escola', 'menu_metodo' => 'apagar-escola']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $contEscola = new \App\bib\Models\BibApagarEscola();
            $this->Dados['contEscola'] = $contEscola->contaEscolaCad();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/escola/verEscola", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Escola não encontrada!</div>";
            $UrlDestino = URLADM . 'escola/listar';
            header("Location: $UrlDestino");
        }
    }

}
