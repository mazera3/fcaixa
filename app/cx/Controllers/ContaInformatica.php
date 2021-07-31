<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaInformatica
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaInformatica
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaInformatica();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_inf' => ['menu_controller' => 'cadastrar-conta-informatica', 'menu_metodo' => 'cad-conta'],
            'vis_inf' => ['menu_controller' => 'ver-conta-informatica', 'menu_metodo' => 'ver-conta'],
            'edit_inf' => ['menu_controller' => 'editar-conta-informatica', 'menu_metodo' => 'edit-conta'],
            'del_inf' => ['menu_controller' => 'apagar-conta-informatica', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaInformatica = new \App\cx\Models\CxListarContaInformatica();
            $this->Dados['listInf'] = $listarContaInformatica->listarContaInformatica($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaInformatica->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaInformatica = new \App\cx\Models\CxListarContaInformatica();
            $this->Dados['listInf'] = $listarContaInformatica->listarContaInformaticaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaInformatica->getResultadoPg();
        } else {
            $listarContaInformatica = new \App\cx\Models\CxListarContaInformatica();
            $this->Dados['listInf'] = $listarContaInformatica->listarContaInformaticaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaInformatica->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaInformatica();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-informatica/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "inf", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaInformatica();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-informatica/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaInformatica", $this->Dados);
        $carregarView->renderizar();
    }
}
