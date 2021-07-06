<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ImportarLeitor
 *
 * @copyright (c) year, Édio Mazera
 */
class ImportarLeitor {

    private $Dados;

    public function importar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['EnviarXml']) OR !empty($this->Dados['EnviarCsv'])) {
            $this->Dados['csv'] = ($_FILES['csv'] ? $_FILES['csv'] : null);
            $this->Dados['xml'] = ($_FILES['xml'] ? $_FILES['xml'] : null);
        }
        if (!empty($this->Dados['xml'])) {
            $import = new \App\cx\Models\CxImportarLeitor();
            $import->importarXml($this->Dados['xml']);
            if ($import->getResultado()) {
                $UrlDestino = URLADM . 'importar-leitor/importar';
                header("Location: $UrlDestino");
            } else {
                $this->importarViewPriv();
            }
        } elseif (!empty($this->Dados['csv'])) {

            $import = new \App\cx\Models\CxImportarLeitor();
            $import->importarCsv($this->Dados['csv']);
            if ($import->getResultado()) {
                $UrlDestino = URLADM . 'importar-leitor/importar';
                header("Location: $UrlDestino");
            } else {
                $this->importarViewPriv();
            }
        } else {
            $this->importarViewPriv();
        }
    }

    private function importarViewPriv() {
        $botao = ['list_leitor' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\cx\core\ConfigView("cx/Views/leitor/importaLeitor", $this->Dados);
        $carregarView->renderizar();
    }

}
