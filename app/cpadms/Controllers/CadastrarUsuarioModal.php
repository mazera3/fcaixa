<?php

namespace App\cpadms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadUsuarioModal
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class CadastrarUsuarioModal {

    private $Dados;

    public function cadUsuario() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);

        unset($_SESSION['msg']);
        $DadosCadUsuario = new \App\cpadms\Models\CpAdmsCadastrarUsuario();
        $DadosCadUsuario->cadUsuario($this->Dados);

        if ($DadosCadUsuario->getResultado()) {
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
