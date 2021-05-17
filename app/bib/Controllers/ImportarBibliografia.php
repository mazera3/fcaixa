<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ImportarBibliografia
 *
 * @copyright (c) year, Édio Mazera
 */
class ImportarBibliografia {

    private $Dados;

    public function importar() {

        $this->Dados['xml'] = ($_FILES['xml'] ? $_FILES['xml'] : null);
        $this->Dados['csv'] = ($_FILES['csv'] ? $_FILES['csv'] : null);

        if (!empty($this->Dados['xml'])) {
            $import = new \App\bib\Models\BibImportarBiblio();
            $import->importarXml($this->Dados['xml']);
            if ($import->getResultado()) {
                $UrlDestino = URLADM . 'importar-bibliografia/importar';
                header("Location: $UrlDestino");
            } else {
                $this->importarViewPriv();
            }
        } elseif (!empty($this->Dados['csv'])) {
            $import = new \App\bib\Models\BibImportarBiblio();
            $import->importarCsv($this->Dados['csv']);
            if ($import->getResultado()) {
                $UrlDestino = URLADM . 'importar-bibliografia/importar';
                header("Location: $UrlDestino");
            } else {
                $this->importarViewPriv();
            }
        } else {
            $this->importarViewPriv();
        }
    }

    private function importarViewPriv() {
        $botao = ['list_bibliografia' => ['menu_controller' => 'bibliografias', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/bibliografia/importarBibliografia", $this->Dados);
        $carregarView->renderizar();
    }

}
