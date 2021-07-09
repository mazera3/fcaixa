<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarRelatorioMensal
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarRelatorioMensal
{

    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function listarRelatorioMensalEnt($DadosMes = null)
    {
        $this->DadosMes = (int) $DadosMes;
        $listarRelatorio = new \App\adms\Models\helper\AdmsRead();
        $listarRelatorio->fullRead("SELECT ent.*, cat.categoria, dc.descricao, m.id_mes FROM cx_entrada ent
        INNER JOIN cx_descricao dc ON dc.id_des=ent.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        INNER JOIN cx_mes m ON m.mes=ent.mes
        WHERE id_mes=:id_mes
        ORDER BY id_ent ASC", "id_mes={$this->DadosMes}");
        $this->Resultado = $listarRelatorio->getResultado();
        return $this->Resultado;
    }

    public function listarRelatorioMensalSai($DadosMes = null)
    {
        $this->DadosMes = (int) $DadosMes;

        $listarRelatorio = new \App\adms\Models\helper\AdmsRead();
        $listarRelatorio->fullRead("SELECT sai.*, cat.categoria, dc.descricao, m.id_mes FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        INNER JOIN cx_mes m ON m.mes=sai.mes
        WHERE id_mes=:id_mes
        ORDER BY id_sai ASC", "id_mes={$this->DadosMes}");
        $this->Resultado = $listarRelatorio->getResultado();
        return $this->Resultado;
    }

    public function listarSaldoAnterior($DadosMes = null)
    {
        $this->DadosMes = (int) $DadosMes - 1;

        $listarSaldo = new \App\adms\Models\helper\AdmsRead();
        $listarSaldo->fullRead("SELECT sal.*, m.id_mes, m.mes, m.extenso FROM cx_saldo sal
        INNER JOIN cx_mes m ON m.id_mes=sal.mes_id
        WHERE id_mes=:id_mes
        ORDER BY id_sal ASC", "id_mes={$this->DadosMes}");
        $this->Resultado = $listarSaldo->getResultado();
        return $this->Resultado;
    }

    public function listarRelatorioFullEnt()
    {
        $listarEntrada = new \App\adms\Models\helper\AdmsRead();
        $listarEntrada->fullRead("SELECT ent.*, cat.categoria, dc.descricao FROM cx_entrada ent
        INNER JOIN cx_descricao dc ON dc.id_des=ent.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ORDER BY id_ent ASC");
        $this->Resultado = $listarEntrada->getResultado();
        return $this->Resultado;
    }

    public function listarRelatorioFullSai()
    {
        $listarSaida = new \App\adms\Models\helper\AdmsRead();
        $listarSaida->fullRead("SELECT sai.*, cat.categoria, dc.descricao FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ORDER BY id_sai ASC");
        $this->Resultado = $listarSaida->getResultado();
        return $this->Resultado;
    }

    public function somarEntradaMensal($DadosMes = null)
    {
        $this->DadosMes = (int) $DadosMes - 1;
        $somarEntrada = new \App\adms\Models\helper\AdmsRead();
        $somarEntrada->fullRead("SELECT SUM(valor) AS total_entrada FROM cx_entrada ent
        INNER JOIN cx_mes m ON m.mes=ent.mes
        WHERE id_mes=:id_mes AND situacao=:situacao", "id_mes={$this->DadosMes}&situacao=1");
        $this->Resultado = $somarEntrada->getResultado();
        return $this->Resultado;
    }

    public function somarSaidaMensal($DadosMes = null)
    {
        $this->DadosMes = (int) $DadosMes - 1;
        $somarSaida = new \App\adms\Models\helper\AdmsRead();
        $somarSaida->fullRead("SELECT SUM(valor) AS total_saida FROM cx_saida sai
        INNER JOIN cx_mes m ON m.mes=sai.mes
        WHERE id_mes=:id_mes AND situacao=:situacao", "id_mes={$this->DadosMes}&situacao=1");
        $this->Resultado = $somarSaida->getResultado();
        return $this->Resultado;
    }
    public function updateSaldo($DadosMes = null, $DadosSaldo = null)
    {
        $this->DadosMes = (int) $DadosMes;
        $this->DadosSaldo = (string) $DadosSaldo;

        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['ano'] = date("Y");
        $this->Dados['saldo'] = $this->DadosSaldo;
        $upAltEntrada = new \App\adms\Models\helper\AdmsUpdate();
        $upAltEntrada->exeUpdate("cx_saldo", $this->Dados, "WHERE mes_id=:mes_id AND ano=:ano", "mes_id={$this->DadosMes}&ano={$this->Dados['ano']}");
        if ($upAltEntrada->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Saldo atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Saldo não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

    public function pagar($DadosId = null, $Pagar = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->Pagar = (int) $Pagar;
        if ($this->Pagar == 1) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['situacao'] = 1;
            $upPagar = new \App\adms\Models\helper\AdmsUpdate();
            $upPagar->exeUpdate("cx_saida", $this->Dados, "WHERE id_sai=:id_sai", "id_sai=" . $this->DadosId);
        }
        if ($this->Pagar == 0) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['situacao'] = 0;
            $upPagar = new \App\adms\Models\helper\AdmsUpdate();
            $upPagar->exeUpdate("cx_saida", $this->Dados, "WHERE id_sai=:id_sai", "id_sai=" . $this->DadosId);
        }
    }

    public function receber($DadosId = null, $Receber = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->Receber = (int) $Receber;
        if ($this->Receber == 1) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['situacao'] = 1;
            $upReceber = new \App\adms\Models\helper\AdmsUpdate();
            $upReceber->exeUpdate("cx_entrada", $this->Dados, "WHERE id_ent=:id_ent", "id_ent=" . $this->DadosId);
        }
        if ($this->Receber == 0) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['situacao'] = 0;
            $upReceber = new \App\adms\Models\helper\AdmsUpdate();
            $upReceber->exeUpdate("cx_entrada", $this->Dados, "WHERE id_ent=:id_ent", "id_ent=" . $this->DadosId);
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT * FROM cx_mes ORDER BY id_mes ASC");
        $registro['mes'] = $listar->getResultado();

        $this->Resultado = [
            'mes' => $registro['mes']
        ];

        return $this->Resultado;
    }
}
