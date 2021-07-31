<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaEducacao
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaEducacao
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaEducacao();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_edu' => ['menu_controller' => 'cadastrar-conta-educacao', 'menu_metodo' => 'cad-conta'],
            'vis_edu' => ['menu_controller' => 'ver-conta-educacao', 'menu_metodo' => 'ver-conta'],
            'edit_edu' => ['menu_controller' => 'editar-conta-educacao', 'menu_metodo' => 'edit-conta'],
            'del_edu' => ['menu_controller' => 'apagar-conta-educacao', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaEducacao = new \App\cx\Models\CxListarContaEducacao();
            $this->Dados['listEdu'] = $listarContaEducacao->listarContaEducacao($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaEducacao->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaEducacao = new \App\cx\Models\CxListarContaEducacao();
            $this->Dados['listEdu'] = $listarContaEducacao->listarContaEducacaoFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaEducacao->getResultadoPg();
        } else {
            $listarContaEducacao = new \App\cx\Models\CxListarContaEducacao();
            $this->Dados['listEdu'] = $listarContaEducacao->listarContaEducacaoFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaEducacao->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaEducacao();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-educacao/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "edu", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaEducacao();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-educacao/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaEducacao", $this->Dados);
        $carregarView->renderizar();
    }
}
