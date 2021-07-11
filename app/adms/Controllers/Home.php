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
class Home
{

    private $Dados;

    public function index()
    {
        $listarSelect = new \App\cx\Models\CxListarRelatorioMensal();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        if (!isset($this->DadosMes)) {
            $this->DadosMes = date('m');
            $this->DadosAno = date('Y');
        }

        $caixaAtual = new \App\cx\Models\CxListarRelatorioMensal();
        $this->Dados['balanco'] = $caixaAtual->listarRelatorioMensalSai($this->DadosMes, $this->DadosAno);

        $carregarView = new \Core\ConfigView("adms/Views/home/home", $this->Dados);
        $carregarView->renderizar();
    }
}
