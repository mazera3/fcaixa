<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Camera
 *
 * @copyright (c) year, Édio Mazera
 */
class Camera {

    private $Dados;

    public function camera() {
        $botao = [
            'cad_leitor' => ['menu_controller' => 'cadastrar-leitor', 'menu_metodo' => 'cad-leitor'],
            'list_leitor' => ['menu_controller' => 'leitores', 'menu_metodo' => 'listar']
        ];

        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \App\bib\core\ConfigView("bib/Views/camera/camera", $this->Dados);
        $carregarView->renderizar();
    }

}
