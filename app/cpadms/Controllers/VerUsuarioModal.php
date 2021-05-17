<?php

namespace App\cpadms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of VerUsuarioModal
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class VerUsuarioModal
{

    private $Dados;
    private $DadosId;

    public function verUsuario($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verUsuario = new \App\adms\Models\AdmsVerUsuario();
            $this->Dados['dados_usuario'] = $verUsuario->verUsuario($this->DadosId);
            //var_dump($this->Dados['dados_usuario']);
            $carregarView = new \App\cpadms\core\ConfigView("cpadms/Views/usuario/verUsuarioModal", $this->Dados);
            $carregarView->renderizarListar();
        }
    }

}
