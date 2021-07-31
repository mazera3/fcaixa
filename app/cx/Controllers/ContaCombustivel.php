<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaCombustivel
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaCombustivel
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaCombustivel();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_comb' => ['menu_controller' => 'cadastrar-conta-combustivel', 'menu_metodo' => 'cad-conta'],
            'vis_comb' => ['menu_controller' => 'ver-conta-combustivel', 'menu_metodo' => 'ver-conta'],
            'edit_comb' => ['menu_controller' => 'editar-conta-combustivel', 'menu_metodo' => 'edit-conta'],
            'del_comb' => ['menu_controller' => 'apagar-conta-combustivel', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaCombustivel = new \App\cx\Models\CxListarContaCombustivel();
            $this->Dados['listComb'] = $listarContaCombustivel->listarContaCombustivel($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaCombustivel->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaCombustivel = new \App\cx\Models\CxListarContaCombustivel();
            $this->Dados['listComb'] = $listarContaCombustivel->listarContaCombustivelFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaCombustivel->getResultadoPg();
        } else {
            $listarContaCombustivel = new \App\cx\Models\CxListarContaCombustivel();
            $this->Dados['listComb'] = $listarContaCombustivel->listarContaCombustivelFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaCombustivel->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaCombustivel();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-combustivel/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "comb", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaCombustivel();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-combustivel/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaCombustivel", $this->Dados);
        $carregarView->renderizar();
    }
}
