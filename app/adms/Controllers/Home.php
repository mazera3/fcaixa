<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Home
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class Home {

    private $Dados;
    private $PageId;

    public function index() {
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $contarLeitores = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarLeitor'] = $contarLeitores->contarLeitor();

        $contarBibliografias = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarBiblio'] = $contarBibliografias->contarBibliografia();
        
        $contarEmprestimos = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarEmprestimo'] = $contarEmprestimos->contarEmprestimo();
        
        $contarCopias = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarCopias'] = $contarCopias->contarCopias();
        
        $contarAtrasos = new \App\bib\Models\BibEstatistica();
        $this->Dados['contarAtrasos'] = $contarAtrasos->contarAtrasos();
        
        //$contarColecao = new \App\bib\Models\BibEstatistica();
       // $this->Dados['contarColecao'] = $contarColecao->contarColecao();

        $carregarView = new \Core\ConfigView("adms/Views/home/home", $this->Dados);
        $carregarView->renderizar();
    }

}
