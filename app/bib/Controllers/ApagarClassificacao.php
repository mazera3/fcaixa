<?php

namespace App\bib\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarClassificacao
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarClassificacao
{

    private $DadosId;

    public function apagarClassificacao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarClassificacao = new \App\bib\Models\BibApagarClassificacao();
           $apagarClassificacao->apagarClassificacao($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma Classificação!</div>";
        }
        $UrlDestino = URLADM . 'classificacao/listar';
        header("Location: $UrlDestino");
    }

}
