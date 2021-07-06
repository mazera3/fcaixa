<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxEditarEntrada
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarEntrada
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

    public function verEntrada($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verEntrada = new \App\adms\Models\helper\AdmsRead();
        $verEntrada->fullRead("SELECT * FROM cx_entrada
                WHERE id_ent =:id_ent LIMIT :limit", "id_ent=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verEntrada->getResultado();
        return $this->Resultado;
    }

    public function altEntrada(array $Dados)
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
            $this->updateEditEntrada();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditEntrada()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['ano'] = date("Y");
        $this->Dados['vencimento'] = $this->VazioVencimento;
        $this->Dados['codigo'] = $this->VazioCodigo;
        $this->Dados['observacao'] = $this->VazioObs;
        
        $upAltEntrada = new \App\adms\Models\helper\AdmsUpdate();
        $upAltEntrada->exeUpdate("cx_entrada", $this->Dados, "WHERE id_ent =:id_ent", "id_ent=" . $this->Dados['id_ent']);
        if ($upAltEntrada->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Entrada atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Entrada não foi atualizada!</div>";
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
