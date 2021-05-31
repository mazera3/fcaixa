<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Pais
 *
 * @copyright (c) year, Édio Mazera
 */
class Qrcode
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_pais' => ['menu_controller' => 'cadastrar-pais', 'menu_metodo' => 'cad-pais'],
            'vis_pais' => ['menu_controller' => 'ver-pais', 'menu_metodo' => 'ver-pais'],
            'edit_pais' => ['menu_controller' => 'editar-pais', 'menu_metodo' => 'edit-pais'],
            'del_pais' => ['menu_controller' => 'apagar-pais', 'menu_metodo' => 'apagar-pais']
        ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        /*
        $qrCode = new \App\bib\Models\helper\QRImageWithText();
        $this->Dados['listPais'] = $qrCode->listarPais($this->PageId);
        $this->Dados['paginacao'] = $qrCode->getResultadoPg();
        */
        $carregarView = new \App\bib\core\ConfigView("bib/Views/pais/listarPais", $this->Dados);
        $carregarView->renderizar();
    }
}
