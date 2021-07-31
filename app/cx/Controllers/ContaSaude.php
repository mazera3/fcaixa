<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaSaude
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaSaude
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaSaude();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_sau' => ['menu_controller' => 'cadastrar-conta-saude', 'menu_metodo' => 'cad-conta'],
            'vis_sau' => ['menu_controller' => 'ver-conta-saude', 'menu_metodo' => 'ver-conta'],
            'edit_sau' => ['menu_controller' => 'editar-conta-saude', 'menu_metodo' => 'edit-conta'],
            'del_sau' => ['menu_controller' => 'apagar-conta-saude', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaSaude = new \App\cx\Models\CxListarContaSaude();
            $this->Dados['listSau'] = $listarContaSaude->listarContaSaude($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaSaude->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaSaude = new \App\cx\Models\CxListarContaSaude();
            $this->Dados['listSau'] = $listarContaSaude->listarContaSaudeFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaSaude->getResultadoPg();
        } else {
            $listarContaSaude = new \App\cx\Models\CxListarContaSaude();
            $this->Dados['listSau'] = $listarContaSaude->listarContaSaudeFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaSaude->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaSaude();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-saude/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "sau", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaSaude();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-saude/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaSaude", $this->Dados);
        $carregarView->renderizar();
    }
}
