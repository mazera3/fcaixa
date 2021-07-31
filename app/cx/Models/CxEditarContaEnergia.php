<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarContaEnergia
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarContaEnergia
{

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $VazioVencimento;
    private $VazioCodigo;
    private $VazioObs;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verConta($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT * FROM cx_conta_energia
                WHERE id_ene =:id_ene LIMIT :limit", "id_ene=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verConta->getResultado();
        return $this->Resultado;
    }

    public function altConta(array $Dados)
    {
        $this->Dados = $Dados;

        $this->VazioCodigo = $this->Dados['codigo'];
        unset($this->Dados['codigo']);
        $this->VazioVencimento = $this->Dados['vencimento'];
        unset($this->Dados['vencimento']);
        $this->VazioObs = $this->Dados['observacao'];
        unset($this->Dados['observacao']);
        $this->Dados['observacao'] = $this->VazioObs;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditConta();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditConta()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['ano'] = date("Y");
        $this->Dados['codigo'] = $this->VazioCodigo;
        $this->Dados['vencimento'] = $this->VazioVencimento;

        $upAltConta = new \App\adms\Models\helper\AdmsUpdate();
        $upAltConta->exeUpdate("cx_conta_energia", $this->Dados, "WHERE id_ene =:id_ene", "id_ene=" . $this->Dados['id_ene']);
        if ($upAltConta->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Conta atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Conta não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC");
        $registro['mes'] = $listar->getResultado();

        $this->Resultado = [
            'mes' => $registro['mes']
        ];

        return $this->Resultado;
    }
}
