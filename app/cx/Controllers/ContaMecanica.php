<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaMecanica
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaMecanica
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaMecanica();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_mec' => ['menu_controller' => 'cadastrar-conta-mecanica', 'menu_metodo' => 'cad-conta'],
            'vis_mec' => ['menu_controller' => 'ver-conta-mecanica', 'menu_metodo' => 'ver-conta'],
            'edit_mec' => ['menu_controller' => 'editar-conta-mecanica', 'menu_metodo' => 'edit-conta'],
            'del_mec' => ['menu_controller' => 'apagar-conta-mecanica', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaMecanica = new \App\cx\Models\CxListarContaMecanica();
            $this->Dados['listMec'] = $listarContaMecanica->listarContaMecanica($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaMecanica->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaMecanica = new \App\cx\Models\CxListarContaMecanica();
            $this->Dados['listMec'] = $listarContaMecanica->listarContaMecanicaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaMecanica->getResultadoPg();
        } else {
            $listarContaMecanica = new \App\cx\Models\CxListarContaMecanica();
            $this->Dados['listMec'] = $listarContaMecanica->listarContaMecanicaFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaMecanica->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaMecanica();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-mecanica/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "mec", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaMecanica();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-mecanica/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaMecanica", $this->Dados);
        $carregarView->renderizar();
    }
}
