<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarEditoraModal
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarEditoraModal
{

    private $Dados;

    public function cadEditora()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($_SESSION['msg']);
        $this->Dados['editora_nova'] = ($_FILES['editora_nova'] ? $_FILES['editora_nova'] : null);
        
        $DadosCadEditora = new \App\bib\Models\BibCadastrarEditoraModal();
        $DadosCadEditora->cadEditora($this->Dados);

        if ($DadosCadEditora->getResultado()) {
            $retorna = ['erro' => true, 'msg' => $_SESSION['msg']];
            unset($_SESSION['msg']);
        } else {
            $retorna = ['erro' => false, 'msg' => $_SESSION['msg']];
            unset($_SESSION['msg']);
        }

        header('Content-Type: application/json');
        echo json_encode($retorna);
    }

}
