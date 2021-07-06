<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarSaida
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

    public function verSaida($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verSaida = new \App\adms\Models\helper\AdmsRead();
        $verSaida->fullRead("SELECT * FROM cx_saida
                WHERE id_sai =:id_sai LIMIT :limit", "id_sai=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verSaida->getResultado();
        return $this->Resultado;
    }

    public function altSaida(array $Dados)
    {
        $this->Dados = $Dados;

        $this->VazioVencimento = $this->Dados['vencimento'];
        unset($this->Dados['vencimento']);
        $this->VazioCodigo = $this->Dados['codigo'];
        unset($this->Dados['codigo']);
        $this->VazioObs = $this->Dados['observacao'];
        unset($this->Dados['observacao']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditSaida();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditSaida()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['ano'] = date("Y");
        $this->Dados['vencimento'] = $this->VazioVencimento;
        $this->Dados['codigo'] = $this->VazioCodigo;
        $this->Dados['observacao'] = $this->VazioObs;

        $upAltSaida = new \App\adms\Models\helper\AdmsUpdate();
        $upAltSaida->exeUpdate("cx_saida", $this->Dados, "WHERE id_sai =:id_sai", "id_sai=" . $this->Dados['id_sai']);
        if ($upAltSaida->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Saida atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Saida não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar() {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id_des, descricao FROM cx_descricao ORDER BY descricao ASC");
        $registro['des'] = $listar->getResultado();

        $listar->fullRead("SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC");
        $registro['mes'] = $listar->getResultado();

        $this->Resultado = [
            'des' => $registro['des'],
            'mes' => $registro['mes']
        ];

        return $this->Resultado;
    }
}
