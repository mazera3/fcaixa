<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarCategoria
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarCategoria
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verCategoria($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verCategoria = new \App\adms\Models\helper\AdmsRead();
        $verCategoria->fullRead("SELECT * FROM cx_categoria
                WHERE id_cat =:id_cat LIMIT :limit", "id_cat=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verCategoria->getResultado();
        return $this->Resultado;
    }

    public function altCategoria(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditCategoria();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditCategoria()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltCategoria = new \App\adms\Models\helper\AdmsUpdate();
        $upAltCategoria->exeUpdate("cx_categoria", $this->Dados, "WHERE id_cat =:id_cat", "id_cat=" . $this->Dados['id_cat']);
        if ($upAltCategoria->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Categoria atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Categoria não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }
}
