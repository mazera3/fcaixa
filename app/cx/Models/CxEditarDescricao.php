<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarDescricao
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarDescricao
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verDescricao($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verDescricao = new \App\adms\Models\helper\AdmsRead();
        $verDescricao->fullRead("SELECT * FROM cx_descricao
                WHERE id_des =:id_des LIMIT :limit", "id_des=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verDescricao->getResultado();
        return $this->Resultado;
    }

    public function altDescricao(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditDescricao();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditDescricao()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltDescricao = new \App\adms\Models\helper\AdmsUpdate();
        $upAltDescricao->exeUpdate("cx_descricao", $this->Dados, "WHERE id_des =:id_des", "id_des=" . $this->Dados['id_des']);
        if ($upAltDescricao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Descricao atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Descricao não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_cat, categoria FROM cx_categoria ORDER BY categoria ASC");
        $registro['cat'] = $listar->getResultado();

        $this->Resultado = ['cat' => $registro['cat']];

        return $this->Resultado;
    }
}
