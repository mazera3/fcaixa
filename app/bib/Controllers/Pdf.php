<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Pdf
 *
 * @copyright (c) year, Édio Mazera
 */
class Pdf {

    private $DadosDb;

    public function pdf() {
        $this->DadosDb = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosDb['Imp'])) {
            unset($this->DadosDb['Imp']);
            $imprime = new \App\bib\Models\BibPdf();
            $imprime->imprimir($this->DadosDb);
        }
        $botao = ['pdf' => ['menu_controller' => 'pdf', 'menu_metodo' => 'pdf']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/pdf/pdf", $this->Dados);
        $carregarView->renderizar();
    }

}
