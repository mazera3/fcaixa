<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Opac
 *
 * @copyright (c) year, Édio Mazera
 */
class Opac
{

    private $Dados;
    private $DadosForm;
    private $PageId;

    public function listar($PageId = null)
    {

        $botao = ['cad_bibliografia' => ['menu_controller' => 'cadastrar-bibliografia', 
                    'menu_metodo' => 'cad-bibliografia'],
            'vis_bibliografia' => ['menu_controller' => 'ver-bibliografia', 
                'menu_metodo' => 'ver-bibliografia'],
            'edit_bibliografia' => ['menu_controller' => 'editar-bibliografia', 
                'menu_metodo' => 'edit-bibliografia'],
            'del_bibliografia' => ['menu_controller' => 'apagar-bibliografia', 
                'menu_metodo' => 'apagar-bibliografia']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['PesqBiblio'])) {
            unset($this->DadosForm['PesqBiblio']);
        } else {
            $this->PageId = (int) $PageId ? $PageId : 1;
            $this->DadosForm['titulo'] = filter_input(INPUT_GET, 'titulo', FILTER_DEFAULT);
            $this->DadosForm['autor'] = filter_input(INPUT_GET, 'autor', FILTER_DEFAULT);
            $this->DadosForm['sub_titulo'] = filter_input(INPUT_GET, 'sub_titulo', FILTER_DEFAULT);
            $this->DadosForm['chamada'] = filter_input(INPUT_GET, 'chamada', FILTER_DEFAULT);
            $this->DadosForm['chave'] = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
        }
        
        $listarBiblio = new \App\bib\Models\BibOpac();
        $this->Dados['listBiblio'] = $listarBiblio->pesquisarBibliografias($this->PageId, $this->DadosForm);
        $this->Dados['paginacao'] = $listarBiblio->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/opac/opac", $this->Dados);
        $carregarView->renderizar();
    }

}
