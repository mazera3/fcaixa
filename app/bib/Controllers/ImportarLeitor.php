<?php

namespace App\bib\Controllers;

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

        $this->Dados['xml'] = ($_FILES['xml'] ? $_FILES['xml'] : null);
        $this->Dados['csv'] = ($_FILES['csv'] ? $_FILES['csv'] : null);

        if (!empty($this->Dados['xml'])) {
            $import = new \App\bib\Models\BibImportarLeitor();
            $import->importarXml($this->Dados['xml']);
            if ($import->getResultado()) {
                $UrlDestino = URLADM . 'importar-leitor/importar';
                header("Location: $UrlDestino");
            } else {
                $this->importarViewPriv();
            }
        } elseif (!empty($this->Dados['csv'])) {
            $import = new \App\bib\Models\BibImportarLeitor();
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

        $carregarView = new \App\bib\core\ConfigView("bib/Views/leitor/importaLeitor", $this->Dados);
        $carregarView->renderizar();
    }

}
