<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarAutorModal
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarAutorModal {

    private $Dados;

    public function cadAutor() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($_SESSION['msg']);
        $this->Dados['foto_nova'] = ($_FILES['foto_nova'] ? $_FILES['foto_nova'] : null);
        
        $DadosCadAutor = new \App\bib\Models\BibCadastrarAutorModal();
        $DadosCadAutor->cadAutor($this->Dados);

        if ($DadosCadAutor->getResultado()) {
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
