<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarCategoria
{

    private $DadosId;
    private $Resultado;
    private $DadosSaidas;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarCategoria($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verDescricaoCad();
        if ($this->Resultado) {
            $this->apagaCategoria();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Categoria não pode ser apagada, há itens cadastrados com esta Categoria!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaCategoria()
    {
        $apagarCategoria = new \App\adms\Models\helper\AdmsDelete();
        $apagarCategoria->exeDelete("cx_categoria", "WHERE id_cat =:id_cat", "id_cat={$this->DadosId}");
        if ($apagarCategoria->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Categoria apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Categoria não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    private function verDescricaoCad()
    {
        $verEntradas = new \App\adms\Models\helper\AdmsRead();
        $verEntradas->fullRead("SELECT id_des FROM cx_descricao
                WHERE id_des =:id_des LIMIT :limit", "id_des=" . $this->DadosId . "&limit=1");
        if ($verEntradas->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Categoria não pode ser apagada, há descição cadastrada com esta Categoria!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }
}
