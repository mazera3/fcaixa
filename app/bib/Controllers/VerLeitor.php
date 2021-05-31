<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
    class VerLeitor {

    private $Dados;
    private $DadosId;
    private $DadosForm;
    private $PageId;
    private $LeitorId;

    public function verLeitor($DadosId = null, $PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verLeitor = new \App\bib\Models\BibVerLeitor();
            $this->Dados['dados_leitor'] = $verLeitor->verLeitor($this->DadosId);

            $botao = [
                'list_leitor' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar'],
                'edit_leitor' => ['menu_controller' => 'editar-leitor', 'menu_metodo' => 'edit-leitor'],
                'qrcode_leitor' => ['menu_controller' => 'ver-leitor', 'menu_metodo' => 'ver-leitor'],
                'del_leitor' => ['menu_controller' => 'apagar-leitor', 'menu_metodo' => 'apagar-leitor'],
                'ret_copia' => ['menu_controller' => 'retirar-copia', 'menu_metodo' => 'retirar-copia'],
                'list_emp' => ['menu_controller' => 'listar-emprestimos', 'menu_metodo' => 'listar-emprestimos'],
                'list_his' => ['menu_controller' => 'listar-historico', 'menu_metodo' => 'listar-historico'],
                'res_copia' => ['menu_controller' => 'reservar-copia', 'menu_metodo' => 'reservar-copia']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->DadosForm['PesqCopia'])) {
                unset($this->DadosForm['PesqCopia']);
            } else {
                $this->PageId = (int) $PageId ? $PageId : 1;
                $this->DadosForm['cod_bar'] = filter_input(INPUT_GET, 'cod_bar', FILTER_DEFAULT);
            }
            $listCopia = new \App\bib\Models\BibRetirarCopia();
            $this->Dados['listCopia'] = $listCopia->pesquisarCopias($this->PageId, $this->DadosForm);

            $this->LeitorId = filter_input(INPUT_GET, "lt", FILTER_SANITIZE_NUMBER_INT);
            if (!empty($this->LeitorId)) {
                // Empréstimos
                $listEmp = new \App\bib\Models\BibRetirarCopia();
                $this->Dados['verEmp'] = $listEmp->listarEmp($this->LeitorId);
            }
            $this->LeitorId = filter_input(INPUT_GET, "leitor", FILTER_SANITIZE_NUMBER_INT);
            if (!empty($this->LeitorId)) {
                // Histórico
                $listHist = new \App\bib\Models\BibRetirarCopia();
                $this->Dados['listHist'] = $listHist->listarHist($this->LeitorId);
            }
            $this->LeitorId = filter_input(INPUT_GET, "qr", FILTER_SANITIZE_NUMBER_INT);
            if (!empty($this->LeitorId)) {
                // Qr Code
                $qrcode = new \App\bib\Models\BibQrCodeLeitor();
                $qrcode->geraQrCode($this->LeitorId);
            }

            $carregarView = new \App\bib\core\ConfigView("bib/Views/leitor/verLeitor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Leitor não encontrado!</div>";
            $UrlDestino = URLADM . 'leitores/listar';
            header("Location: $UrlDestino");
        }
    }

}
