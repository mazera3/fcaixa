<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaEnergia
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaEnergia();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_ene' => ['menu_controller' => 'cadastrar-conta-energia', 'menu_metodo' => 'cad-conta'],
            'vis_ene' => ['menu_controller' => 'ver-conta-energia', 'menu_metodo' => 'ver-conta'],
            'edit_ene' => ['menu_controller' => 'editar-conta-energia', 'menu_metodo' => 'edit-conta'],
            'del_ene' => ['menu_controller' => 'apagar-conta-energia', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaEnergia = new \App\cx\Models\CxListarContaEnergia();
            $this->Dados['listEne'] = $listarContaEnergia->listarContaEnergia($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaEnergia->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaEnergia = new \App\cx\Models\CxListarContaEnergia();
            $this->Dados['listEne'] = $listarContaEnergia->listarContaEnergiaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaEnergia->getResultadoPg();
        } else {
            $listarContaEnergia = new \App\cx\Models\CxListarContaEnergia();
            $this->Dados['listEne'] = $listarContaEnergia->listarContaEnergiaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaEnergia->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaEnergia();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-energia/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "ene", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaEnergia();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-energia/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaEnergia", $this->Dados);
        $carregarView->renderizar();
    }
}
