<?php

namespace App\cpadms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarUsuarioModal
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ApagarUsuarioModal
{

    private $DadosId;

    public function apagarUsuario($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarUsuario = new \App\adms\Models\AdmsApagarUsuario();
           $apagarUsuario->apagarUsuario($this->DadosId); //Modal
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um usuário!</div>";
        }
        $UrlDestino = URLADM . 'carregar-usuarios-js/listar';
        header("Location: $UrlDestino");
    }

}
