<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaAgropecuaria
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaAgropecuaria
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaAgropecuaria();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_agr' => ['menu_controller' => 'cadastrar-conta-agropecuaria', 'menu_metodo' => 'cad-conta'],
            'vis_agr' => ['menu_controller' => 'ver-conta-agropecuaria', 'menu_metodo' => 'ver-conta'],
            'edit_agr' => ['menu_controller' => 'editar-conta-agropecuaria', 'menu_metodo' => 'edit-conta'],
            'del_agr' => ['menu_controller' => 'apagar-conta-agropecuaria', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaAgropecuaria = new \App\cx\Models\CxListarContaAgropecuaria();
            $this->Dados['listAgr'] = $listarContaAgropecuaria->listarContaAgropecuaria($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaAgropecuaria->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaAgropecuaria = new \App\cx\Models\CxListarContaAgropecuaria();
            $this->Dados['listAgr'] = $listarContaAgropecuaria->listarContaAgropecuariaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaAgropecuaria->getResultadoPg();
        } else {
            $listarContaAgropecuaria = new \App\cx\Models\CxListarContaAgropecuaria();
            $this->Dados['listAgr'] = $listarContaAgropecuaria->listarContaAgropecuariaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaAgropecuaria->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaAgropecuaria();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-agropecuaria/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "agr", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaAgropecuaria();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-agropecuaria/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaAgropecuaria", $this->Dados);
        $carregarView->renderizar();
    }
}
