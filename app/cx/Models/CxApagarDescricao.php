<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxApagarDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarDescricao
{

    private $DadosId;
    private $Resultado;
    private $DadosSaidas;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarDescricao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verEntradasCad();
        if ($this->Resultado) {
            $this->verSaidasCad();
            if ($this->Resultado) {
                $this->apagaDescricao();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta Descricao não foi apagada!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Descricao não pode ser apagada, há itens cadastrados com esta Descricao!!</div>";
            $this->Resultado = false;
        }
    }

    private function apagaDescricao()
    {
        $apagarDescricao = new \App\adms\Models\helper\AdmsDelete();
        $apagarDescricao->exeDelete("cx_descricao", "WHERE id_des =:id_des", "id_des={$this->DadosId}");
        if ($apagarDescricao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Descricao apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Descricao não foi apagada!!</div>";
            $this->Resultado = false;
        }
    }

    private function verEntradasCad()
    {
        $verEntradas = new \App\adms\Models\helper\AdmsRead();
        $verEntradas->fullRead("SELECT id FROM cx_entradas
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        if ($verEntradas->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Descricao não pode ser apagada, há entradas cadastradas com esta Descricao!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verSaidasCad()
    {
        $verSaidas = new \App\adms\Models\helper\AdmsRead();
        $verSaidas->fullRead("SELECT id FROM cx_saidas
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        if ($verSaidas->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Erro: A Descricao não pode ser apagada, há saidas cadastradas com esta Descricao!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }
}
