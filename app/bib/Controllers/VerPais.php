<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerPais
 *
 * @copyright (c) year, Édio Mazera
 */
class VerPais
{

    private $Dados;
    private $DadosId;

    public function verPais($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        
        if (!empty($this->DadosId)) {
            $verPais = new \App\bib\Models\BibVerPais();
            $this->Dados['dados_pais'] = $verPais->verPais($this->DadosId);           
            
            $botao = ['list_pais' => ['menu_controller' => 'pais', 'menu_metodo' => 'listar'],
                'edit_pais' => ['menu_controller' => 'editar-pais', 'menu_metodo' => 'edit-pais'],
                'del_pais' => ['menu_controller' => 'apagar-pais', 'menu_metodo' => 'apagar-pais']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\bib\core\ConfigView("bib/Views/pais/verPais", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Pais não encontrado!</div>";
            $UrlDestino = URLADM . 'pais/listar';
            header("Location: $UrlDestino");
        }
    }

}
