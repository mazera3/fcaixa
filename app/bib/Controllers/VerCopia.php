<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerCopia
 *
 * @copyright (c) year, Édio Mazera
 */
class VerCopia {

    private $Dados;
    private $DadosId;

    public function verCopia($DadosId = null) {

        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verCopia = new \App\bib\Models\BibVerCopia();
            $this->Dados['dados_copia'] = $verCopia->verCopia($this->DadosId);

            $botao = [
                'list_copia' => ['menu_controller' => 'copias', 'menu_metodo' => 'listar'],
                'cad_copia' => ['menu_controller' => 'cadastrar-copia','menu_metodo' => 'cad-copia'],
                'edit_copia' => ['menu_controller' => 'editar-copia', 'menu_metodo' => 'edit-copia'],
                'del_copia' => ['menu_controller' => 'apagar-copia', 'menu_metodo' => 'apagar-copia'],
                'codebar_copia' => ['menu_controller' => 'ver-copia', 'menu_metodo' => 'ver-copia']
            ];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            
            $this->DadosId = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
            if (!empty($this->DadosId)) {
                // Code Bar
                $codeBar = new \App\bib\Models\BibCodeBarOn();
                $codeBar->geraCodeBar($this->DadosId);
            }

            $carregarView = new \App\bib\core\ConfigView("bib/Views/copia/verCopia", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cópia não encontrada!!!</div>";
            $UrlDestino = URLADM . 'copias/listar';
            header("Location: $UrlDestino");
        }
    }

}
