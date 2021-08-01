<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaLoja
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaLoja
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaLoja();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_loj' => ['menu_controller' => 'cadastrar-conta-loja', 'menu_metodo' => 'cad-conta'],
            'vis_loj' => ['menu_controller' => 'ver-conta-loja', 'menu_metodo' => 'ver-conta'],
            'edit_loj' => ['menu_controller' => 'editar-conta-loja', 'menu_metodo' => 'edit-conta'],
            'del_loj' => ['menu_controller' => 'apagar-conta-loja', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaLoja = new \App\cx\Models\CxListarContaLoja();
            $this->Dados['listLoj'] = $listarContaLoja->listarContaLoja($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaLoja->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaLoja = new \App\cx\Models\CxListarContaLoja();
            $this->Dados['listLoj'] = $listarContaLoja->listarContaLojaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaLoja->getResultadoPg();
        } else {
            $listarContaLoja = new \App\cx\Models\CxListarContaLoja();
            $this->Dados['listLoj'] = $listarContaLoja->listarContaLojaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaLoja->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaLoja();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-loja/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "loj", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaLoja();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-loja/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaLoja", $this->Dados);
        $carregarView->renderizar();
    }
}
