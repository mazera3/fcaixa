<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarSaldo
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarSaldo
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verSaldo($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verSaldo = new \App\adms\Models\helper\AdmsRead();
        $verSaldo->fullRead("SELECT * FROM cx_saldo
                WHERE id_sal =:id_sal LIMIT :limit", "id_sal=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verSaldo->getResultado();
        return $this->Resultado;
    }

    public function altSaldo(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditSaldo();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditSaldo()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltSaldo = new \App\adms\Models\helper\AdmsUpdate();
        $upAltSaldo->exeUpdate("cx_saldo", $this->Dados, "WHERE id_sal =:id_sal", "id_sal=" . $this->Dados['id_sal']);
        if ($upAltSaldo->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Saldo atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Saldo não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC");
        $registro['mes'] = $listar->getResultado();

        $this->Resultado = ['mes' => $registro['mes']];

        return $this->Resultado;
    }
}
