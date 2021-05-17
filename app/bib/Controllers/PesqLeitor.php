<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Leitores
 *
 * @copyright (c) year, Édio Mazera
 */
class PesqLeitor {

    private $Dados;
    private $DadosForm;
    private $PageId;

    public function listar($PageId = null) {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'cad_leitor' => ['menu_controller' => 'cadastrar-leitor','menu_metodo' => 'cad-leitor'],
            'list_leitor' => ['menu_controller' => 'leitores','menu_metodo' => 'listar'],
            'vis_leitor' => ['menu_controller' => 'ver-leitor','menu_metodo' => 'ver-leitor'],
            'edit_leitor' => ['menu_controller' => 'editar-leitor','menu_metodo' => 'edit-leitor'],
            'del_leitor' => ['menu_controller' => 'apagar-leitor','menu_metodo' => 'apagar-leitor']
            ];

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['PesqLeitor'])) {
            unset($this->DadosForm['PesqLeitor']);
        } else {
            $this->PageId = (int) $PageId ? $PageId : 1;
            $this->DadosForm['nome'] = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);
            $this->DadosForm['matricula'] = filter_input(INPUT_GET, 'matricula', FILTER_DEFAULT);
            $this->DadosForm['chave'] = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
        }
        
        $pequisarLeitor = new \App\bib\Models\BibListarLeitor();
        $this->Dados['listLeitor'] = $pequisarLeitor->pesquisarLeitores($this->PageId, $this->DadosForm);
        $this->Dados['paginacao'] = $pequisarLeitor->getResultadoPg();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/leitor/pesqLeitor", $this->Dados);
        $carregarView->renderizar();
    }

}
