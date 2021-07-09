<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaMercado
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaMercado
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaMercado();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_mer' => ['menu_controller' => 'cadastrar-conta-mercado', 'menu_metodo' => 'cad-conta'],
            'vis_mer' => ['menu_controller' => 'ver-conta-mercado', 'menu_metodo' => 'ver-conta'],
            'edit_mer' => ['menu_controller' => 'editar-conta-mercado', 'menu_metodo' => 'edit-conta'],
            'del_mer' => ['menu_controller' => 'apagar-conta-mercado', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaMercado = new \App\cx\Models\CxListarContaMercado();
            $this->Dados['listMer'] = $listarContaMercado->listarContaMercado($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaMercado->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaMercado = new \App\cx\Models\CxListarContaMercado();
            $this->Dados['listMer'] = $listarContaMercado->listarContaMercadoFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaMercado->getResultadoPg();
        } else {
            $listarContaMercado = new \App\cx\Models\CxListarContaMercado();
            $this->Dados['listMer'] = $listarContaMercado->listarContaMercadoFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaMercado->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaMercado();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-mercado/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "mer", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaMercado();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-mercado/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaMercado", $this->Dados);
        $carregarView->renderizar();
    }
}
