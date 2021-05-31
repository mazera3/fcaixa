<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of QrCodigo
 *
 * @copyright (c) year, Édio Mazera
 */
class QrCodigo {

    private $DadosQR;
    private $Dados;

    public function listar() {

        $this->DadosQR = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosQR['QrCode'])) {
            unset($this->DadosQR['QrCode']);
            $qrcode = new \App\bib\Models\BibQrCode();
            $this->Dados['listQr'] = $qrcode->geraQrCode($this->DadosQR);
        }

        $botao = ['qr_code' => ['menu_controller' => 'qrcode', 'menu_metodo' => 'qrcode']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/qrcode/qrcode", $this->Dados);
        $carregarView->renderizar();
    }

}
