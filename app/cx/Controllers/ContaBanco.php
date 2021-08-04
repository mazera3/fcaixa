<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaBanco
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaBanco
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaBanco();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_ban' => ['menu_controller' => 'cadastrar-conta-banco', 'menu_metodo' => 'cad-conta'],
            'vis_ban' => ['menu_controller' => 'ver-conta-banco', 'menu_metodo' => 'ver-conta'],
            'edit_ban' => ['menu_controller' => 'editar-conta-banco', 'menu_metodo' => 'edit-conta'],
            'del_ban' => ['menu_controller' => 'apagar-conta-banco', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarConta = new \App\cx\Models\CxListarContaBanco();
            $this->Dados['listBan'] = $listarConta->listarContaBanco($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarConta->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarConta = new \App\cx\Models\CxListarContaBanco();
            $this->Dados['listBan'] = $listarConta->listarContaBancoFull($this->PageId);
            $this->Dados['paginacao'] = $listarConta->getResultadoPg();
        } else {
            $listarConta = new \App\cx\Models\CxListarContaBanco();
            $this->Dados['listBan'] = $listarConta->listarContaBancoFull($this->PageId);
            $this->Dados['paginacao'] = $listarConta->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaBanco();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-banco/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "ban", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaBanco();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-banco/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/extras/listarContaBanco", $this->Dados);
        $carregarView->renderizar();
    }
}
