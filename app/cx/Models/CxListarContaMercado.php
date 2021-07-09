<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarContaMercado
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarContaMercado
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10;
    private $ResultadoPg;

    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    public function listarContaMercado($PageId = null, $DadosAno = null, $DadosMes = null)
    {
        $this->PageId = (int) $PageId;
        $this->DadosAno = (int) $DadosAno;
        $this->DadosMes = (int) $DadosMes;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-mercado/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_mer) AS num_result FROM cx_conta_mercado mer
        INNER JOIN cx_mes m ON m.id_mes=mer.mes_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarContaMercado = new \App\adms\Models\helper\AdmsRead();
        $listarContaMercado->fullRead("SELECT mer.*, m.mes, m.id_mes FROM cx_conta_mercado mer
        INNER JOIN cx_mes m ON m.id_mes=mer.mes_id
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_mer ASC LIMIT :limit OFFSET :offset", "ano={$this->DadosAno}&id_mes={$this->DadosMes}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarContaMercado->getResultado();
        return $this->Resultado;
    }

    public function listarContaMercadoFull($PageId = null)
    {
        $this->PageId = (int) $PageId;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-mercado/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_mer) AS num_result FROM cx_conta_mercado mer
        INNER JOIN cx_mes m ON m.id_mes=mer.mes_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarContaMercado = new \App\adms\Models\helper\AdmsRead();
        $listarContaMercado->fullRead("SELECT mer.*, m.mes, m.id_mes FROM cx_conta_mercado mer
        INNER JOIN cx_mes m ON m.id_mes=mer.mes_id
        ORDER BY id_mer ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarContaMercado->getResultado();
        return $this->Resultado;
    }

    public function pagar($DadosId = null, $Pagar = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->Pagar = (int) $Pagar;
        if ($this->Pagar == 1) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['situacao'] = 1;
            $upPagar = new \App\adms\Models\helper\AdmsUpdate();
            $upPagar->exeUpdate("cx_conta_mercado", $this->Dados, "WHERE id_mer=:id_mer", "id_mer=" . $this->DadosId);
        }
        if ($this->Pagar == 0) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['situacao'] = 0;
            $upPagar = new \App\adms\Models\helper\AdmsUpdate();
            $upPagar->exeUpdate("cx_conta_mercado", $this->Dados, "WHERE id_mer=:id_mer", "id_mer=" . $this->DadosId);
        }
    }

    public function atualizar($Valor = null, $DadosMes = null)
    {
        $this->Valor = (string) $Valor;
        $this->DadosMes = (string) $DadosMes;
        $ano = date('Y');
        $verMercado = new \App\adms\Models\helper\AdmsRead();
        $verMercado->fullRead("SELECT * FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        WHERE dc.descricao LIKE '%' :mer '%' AND ano=:ano AND mes=:mes", "mes={$this->DadosMes}&ano={$ano}&mer=Mercados");
        $this->Resultado = $verMercado->getResultado();
        if ($this->Resultado) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['valor'] = $this->Valor;
            $this->Dados['situacao'] = 1;
            $id = $this->Resultado[0]['id_sai'];
            $upAtualizar = new \App\adms\Models\helper\AdmsUpdate();
            $upAtualizar->exeUpdate("cx_saida", $this->Dados, "WHERE id_sai=:id_sai", "id_sai={$id}");
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
