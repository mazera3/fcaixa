<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Saida
 *
 * @copyright (c) year, Édio Mazera
 */
class Saida
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarEntrada();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_sai' => ['menu_controller' => 'cadastrar-saida', 'menu_metodo' => 'cad-saida'],
            'vis_sai' => ['menu_controller' => 'ver-saida', 'menu_metodo' => 'ver-saida'],
            'edit_sai' => ['menu_controller' => 'editar-saida', 'menu_metodo' => 'edit-saida'],
            'del_sai' => ['menu_controller' => 'apagar-saida', 'menu_metodo' => 'apagar-saida']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarSaida = new \App\cx\Models\CxListarSaida();
            $this->Dados['listSai'] = $listarSaida->listarSaida($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarSaida->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarSaida = new \App\cx\Models\CxListarSaida();
            $this->Dados['listSai'] = $listarSaida->listarSaidaFull($this->PageId);
            $this->Dados['paginacao'] = $listarSaida->getResultadoPg();
        } else {
            $listarSaida = new \App\cx\Models\CxListarSaida();
            $this->Dados['listSai'] = $listarSaida->listarSaidaFull($this->PageId);
            $this->Dados['paginacao'] = $listarSaida->getResultadoPg();
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/saida/listarSaida", $this->Dados);
        $carregarView->renderizar();
    }
}
