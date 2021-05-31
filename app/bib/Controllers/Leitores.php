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
    private $Sicronizar;
    private $PageId;
    private $SituacaoLt;
    private $DadosPdf;
    private $DadosXls;

    public function listar($PageId = null, $SituacaoLt = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_leitor' => ['menu_controller' => 'cadastrar-leitor', 'menu_metodo' => 'cad-leitor'],
            'imp_leitor' => ['menu_controller' => 'importar-leitor', 'menu_metodo' => 'importar'],
            'pesq_leitor' => ['menu_controller' => 'pesq-leitor', 'menu_metodo' => 'listar'],
            'list_leitor' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar'],
            'sincronizar' => ['menu_controller' => 'sincronizar', 'menu_metodo' => 'sincronizar'],
            'vis_leitor' => ['menu_controller' => 'ver-leitor', 'menu_metodo' => 'ver-leitor'],
            'edit_leitor' => ['menu_controller' => 'editar-leitor', 'menu_metodo' => 'edit-leitor'],
            'del_leitor' => ['menu_controller' => 'apagar-leitor', 'menu_metodo' => 'apagar-leitor'],
            'pdf' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar'],
            'xls' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar']
        ];

        $this->DadosPdf = filter_input(INPUT_GET, "pdf", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosPdf)) {
            $imprime = new \App\bib\Models\BibPdfLeitores();
            $imprime->pdf($this->DadosPdf);
        }
        $this->DadosXls = filter_input(INPUT_GET, "xls", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosXls)) {
            $imprime = new \App\bib\Models\BibXlsLeitores();
            $imprime->xls($this->DadosXls);
        }

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->SituacaoLt = filter_input(INPUT_GET, "st", FILTER_SANITIZE_NUMBER_INT);
        //if (!empty($this->SituacaoLt)) {
        if ($this->SituacaoLt == 5) {
            $listarLeitor = new \App\bib\Models\BibListarLeitor();
            $this->Dados['listLeitor'] = $listarLeitor->listarLeitor($this->PageId, $this->SituacaoLt);
            $this->Dados['paginacao'] = $listarLeitor->getResultadoPg();
        } else {
            $this->SituacaoLt = (int) $SituacaoLt ? $SituacaoLt : 1;
            $listarLeitor = new \App\bib\Models\BibListarLeitor();
            $this->Dados['listLeitor'] = $listarLeitor->listarLeitor($this->PageId, $this->SituacaoLt);
            $this->Dados['paginacao'] = $listarLeitor->getResultadoPg();
        }
        $this->Sicronizar = filter_input(INPUT_GET, "sinc", FILTER_SANITIZE_STRING);
        if ($this->Sicronizar) {
            $sincronizar = new \App\bib\Models\BibReservarCopia();
            $sincronizar->sinCopia();
        }

        $carregarView = new \App\bib\core\ConfigView("bib/Views/leitor/listarLeitor", $this->Dados);
        $carregarView->renderizar();
    }

}
