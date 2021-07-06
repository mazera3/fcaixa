<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Entrada
 *
 * @copyright (c) year, Édio Mazera
 */
class Entrada
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarEntrada();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_ent' => ['menu_controller' => 'cadastrar-entrada', 'menu_metodo' => 'cad-entrada'],
            'vis_ent' => ['menu_controller' => 'ver-entrada', 'menu_metodo' => 'ver-entrada'],
            'edit_ent' => ['menu_controller' => 'editar-entrada', 'menu_metodo' => 'edit-entrada'],
            'del_ent' => ['menu_controller' => 'apagar-entrada', 'menu_metodo' => 'apagar-entrada']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarEntrada = new \App\cx\Models\CxListarEntrada();
            $this->Dados['listEnt'] = $listarEntrada->listarEntrada($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarEntrada->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarEntrada = new \App\cx\Models\CxListarEntrada();
            $this->Dados['listEnt'] = $listarEntrada->listarEntradaFull($this->PageId);
            $this->Dados['paginacao'] = $listarEntrada->getResultadoPg();
        } else {
            $listarEntrada = new \App\cx\Models\CxListarEntrada();
            $this->Dados['listEnt'] = $listarEntrada->listarEntradaFull($this->PageId);
            $this->Dados['paginacao'] = $listarEntrada->getResultadoPg();
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/entrada/listarEntrada", $this->Dados);
        $carregarView->renderizar();
    }
}
