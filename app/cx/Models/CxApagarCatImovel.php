<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarCatImovel
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarCatImovel
{

    private $DadosId;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarCatImovel($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verParimonioCad();
        if ($this->Resultado) {
            $this->apagaCatImovel();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Categoria deste Imóvel não pode ser apagada, há itens cadastrados com esta Categoria!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaCatImovel()
    {
        $apagarCatImovel = new \App\adms\Models\helper\AdmsDelete();
        $apagarCatImovel->exeDelete("cx_imovel", "WHERE id_imv =:id_imv", "id_imv={$this->DadosId}");
        if ($apagarCatImovel->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>CatImovel apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: CatImovel não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    private function verParimonioCad()
    {
        $verPatrimonio = new \App\adms\Models\helper\AdmsRead();
        $verPatrimonio->fullRead("SELECT cod_pat FROM cx_patrimonio
                WHERE cod_pat =:cod_pat LIMIT :limit", "cod_pat=" . $this->DadosId . "&limit=1");
        if ($verPatrimonio->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Cateoria desse Imovel não pode ser apagada, há patrimonio cadastrado com esta Categoria!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }
}
