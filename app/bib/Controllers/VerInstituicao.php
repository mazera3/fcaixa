<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerInstituicao
 *
 * @copyright (c) year, Édio Mazera
 */
class VerInstituicao {

    private $Dados;
    private $DadosId;

    public function verInstituicao($DadosId = null) {

        $this->DadosId = (int) $DadosId;

        if (!empty($this->DadosId)) {
            $verInstituicao = new \App\bib\Models\BibVerInstituicao();
            $this->Dados['dados_instituicao'] = $verInstituicao->verInstituicao($this->DadosId);

            $botao = [
                'list_instituicao' => ['menu_controller' => 'instituicao', 'menu_metodo' => 'listar'],
                'edit_instituicao' => ['menu_controller' => 'editar-instituicao', 'menu_metodo' => 'edit-instituicao'],
                'del_instituicao' => ['menu_controller' => 'apagar-instituicao', 'menu_metodo' => 'apagar-instituicao']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $contInstituicao = new \App\bib\Models\BibApagarInstituicao();
            $this->Dados['contInstituicao'] = $contInstituicao->contaInstituicaoCad();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/instituicao/verInstituicao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Instituicao não encontrada!</div>";
            $UrlDestino = URLADM . 'instituicao/listar';
            header("Location: $UrlDestino");
        }
    }

}
