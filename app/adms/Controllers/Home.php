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
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $caixaAtual = new \App\cx\Models\CxListarRelatorioMensal();
        $this->Dados['mes_atual'] = $caixaAtual->listarRelatorioMensalSai(date('m'), date('Y'));
        //var_dump($this->Dados['mes_atual']);

        $carregarView = new \Core\ConfigView("adms/Views/home/home", $this->Dados);
        $carregarView->renderizar();
    }
}
