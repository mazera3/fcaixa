<?php

namespace App\cpadms\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CpAdmsValidarImg
 *
 * @copyright (c) year, Édio mazera
 */
class CpAdmsValidarImg {

    private $DadosImagem;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function validarImagem(array $Imagem) {
        $this->DadosImagem = $Imagem;

        switch ($this->DadosImagem['type']):
            case 'image/jpeg';
            case 'image/pjpeg';
                $this->Resultado = true;
                break;
            case 'image/png':
            case 'image/x-png';
                $this->Resultado = true;
                break;
            default:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A extensão da imagem é inválida. Selecione um imagem JPEG ou PNG!</div>";
                $this->Resultado = false;
        endswitch;
    }

}
