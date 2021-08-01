<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ContaFone
 *
 * @copyright (c) year, Édio Mazera
 */
class ContaFone
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $listarSelect = new \App\cx\Models\CxListarContaFone();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = [
            'cad_fon' => ['menu_controller' => 'cadastrar-conta-fone', 'menu_metodo' => 'cad-conta'],
            'vis_fon' => ['menu_controller' => 'ver-conta-fone', 'menu_metodo' => 'ver-conta'],
            'edit_fon' => ['menu_controller' => 'editar-conta-fone', 'menu_metodo' => 'edit-conta'],
            'del_fon' => ['menu_controller' => 'apagar-conta-fone', 'menu_metodo' => 'apagar-conta']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosMes = filter_input(INPUT_GET, "mes", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAno = filter_input(INPUT_GET, "ano", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosAll = filter_input(INPUT_GET, "all", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->DadosMes)) {
            $listarContaFone = new \App\cx\Models\CxListarContaFone();
            $this->Dados['listFon'] = $listarContaFone->listarContaFone($this->PageId, $this->DadosAno, $this->DadosMes);
            $this->Dados['paginacao'] = $listarContaFone->getResultadoPg();
        } elseif (!empty($this->DadosAll)) {
            $listarContaFone = new \App\cx\Models\CxListarContaFone();
            $this->Dados['listFon'] = $listarContaFone->listarContaFoneFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaFone->getResultadoPg();
        } else {
            $listarContaFone = new \App\cx\Models\CxListarContaFone();
            $this->Dados['listFon'] = $listarContaFone->listarContaFoneFull($this->PageId);
            $this->Dados['paginacao'] = $listarContaFone->getResultadoPg();
        }

        $this->DadosId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->Pagar = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Pagar)) {
            $Pagar = new \App\cx\Models\CxListarContaFone();
            $Pagar->pagar($this->DadosId, $this->Pagar);
            $UrlDestino = URLADM . "conta-fone/listar?mes={$this->DadosMes}";
            header("Location: $UrlDestino");
        }

        $this->Valor = filter_input(INPUT_GET, "fon", FILTER_SANITIZE_STRING);
        $this->DadosMes = filter_input(INPUT_GET, "ms", FILTER_SANITIZE_STRING);
        $this->DadosAno = filter_input(INPUT_GET, "an", FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->Valor)) {
            $Atualizar = new \App\cx\Models\CxListarContaFone();
            $this->Dados['value'] = $Atualizar->atualizar($this->Valor, $this->DadosAno, $this->DadosMes);
            //$UrlDestino = URLADM . "conta-fone/listar";
            //header("Location: $UrlDestino");
        }

        $carregarView = new \App\cx\core\ConfigView("cx/Views/contas/listarContaFone", $this->Dados);
        $carregarView->renderizar();
    }
}
