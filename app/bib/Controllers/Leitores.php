<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Leitores
 *
 * @copyright (c) year, Édio Mazera
 */
class Leitores {

    private $Dados;
    private $DadosForm;
    private $PageId;
    private $SituacaoLt;

    public function listar($PageId = null, $SituacaoLt = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_leitor' => ['menu_controller' => 'cadastrar-leitor', 'menu_metodo' => 'cad-leitor'],
            'imp_leitor' => ['menu_controller' => 'importar-leitor', 'menu_metodo' => 'importar'],
            'pesq_leitor' => ['menu_controller' => 'pesq-leitor', 'menu_metodo' => 'listar'],
            'list_leitor' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar'],
            'vis_leitor' => ['menu_controller' => 'ver-leitor', 'menu_metodo' => 'ver-leitor'],
            'edit_leitor' => ['menu_controller' => 'editar-leitor', 'menu_metodo' => 'edit-leitor'],
            'del_leitor' => ['menu_controller' => 'apagar-leitor', 'menu_metodo' => 'apagar-leitor']
        ];

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->SituacaoLt = filter_input(INPUT_GET, "st", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->SituacaoLt)) {
            $listarLeitor = new \App\bib\Models\BibListarLeitor();
            $this->Dados['listLeitor'] = $listarLeitor->listarLeitor($this->PageId, $this->SituacaoLt);
            $this->Dados['paginacao'] = $listarLeitor->getResultadoPg();
        } else {
            $this->SituacaoLt = (int) $SituacaoLt ? $SituacaoLt : 1;
            $listarLeitor = new \App\bib\Models\BibListarLeitor();
            $this->Dados['listLeitor'] = $listarLeitor->listarLeitor($this->PageId, $this->SituacaoLt);
            $this->Dados['paginacao'] = $listarLeitor->getResultadoPg();
        }

        $carregarView = new \App\bib\core\ConfigView("bib/Views/leitor/listarLeitor", $this->Dados);
        $carregarView->renderizar();
    }

}
