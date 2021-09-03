<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}
/**
 * Description of CxListarContaSocial
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarContaSocial
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 100;
    private $ResultadoPg;

    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    public function listarContaSocial($PageId = null, $DadosAno = null, $DadosMes = null)
    {
        $this->PageId = (int) $PageId;
        $this->DadosAno = (int) $DadosAno;
        $this->DadosMes = (int) $DadosMes;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-social/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_soc) AS num_result FROM cx_conta_social soc
        INNER JOIN cx_mes m ON m.id_mes=soc.mes_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarConta = new \App\adms\Models\helper\AdmsRead();
        $listarConta->fullRead("SELECT soc.*, m.* FROM cx_conta_social soc
        INNER JOIN cx_mes m ON m.id_mes=soc.mes_id
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_soc ASC LIMIT :limit OFFSET :offset", "ano={$this->DadosAno}&id_mes={$this->DadosMes}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarConta->getResultado();
        return $this->Resultado;
    }

    public function listarContaSocialFull($PageId = null)
    {
        $this->PageId = (int) $PageId;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-social/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_soc) AS num_result FROM cx_conta_social soc
        INNER JOIN cx_mes m ON m.id_mes=soc.mes_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarConta = new \App\adms\Models\helper\AdmsRead();
        $listarConta->fullRead("SELECT soc.*, m.* FROM cx_conta_social soc
        INNER JOIN cx_mes m ON m.id_mes=soc.mes_id
        ORDER BY id_soc ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarConta->getResultado();
        return $this->Resultado;
    }

    public function pagar($DadosId = null, $Pagar = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->Pagar = (int) $Pagar;
        if ($this->Pagar == 1) {
            $this->Dados['modified'] = date('Y-m-d H:i:s');
            $this->Dados['situacao'] = 1;
            $upPagar = new \App\adms\Models\helper\AdmsUpdate();
            $upPagar->exeUpdate("cx_conta_social", $this->Dados, "WHERE id_soc=:id_soc", "id_soc=" . $this->DadosId);
        }
        if ($this->Pagar == 0) {
            $this->Dados['modified'] = date('Y-m-d H:i:s');
            $this->Dados['situacao'] = 0;
            $upPagar = new \App\adms\Models\helper\AdmsUpdate();
            $upPagar->exeUpdate("cx_conta_social", $this->Dados, "WHERE id_soc=:id_soc", "id_soc=" . $this->DadosId);
        }
    }

    public function atualizar($Valor = null, $DadosAno = null, $DadosMes = null)
    {
        $this->Valor = (string) $Valor;
        $this->DadosMes = (string) $DadosMes;
        $this->DadosAno = (string) $DadosAno;

        $verConta = new \App\adms\Models\helper\AdmsRead();
        $verConta->fullRead("SELECT * FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        WHERE dc.descricao LIKE '%' :soc '%' AND ano=:ano AND mes_id=:mes_id", "mes_id={$this->DadosMes}&ano={$this->DadosAno}&soc=Social");
        $this->Resultado = $verConta->getResultado();
        if ($this->Resultado) {
            $this->Dados['modified'] = date('Y-m-d H:i:s');
            $this->Dados['valor'] = $this->Valor;
            $this->Dados['situacao'] = 1;
            $id = $this->Resultado[0]['id_sai'];
            $upAtualizar = new \App\adms\Models\helper\AdmsUpdate();
            $upAtualizar->exeUpdate("cx_saida", $this->Dados, "WHERE id_sai=:id_sai", "id_sai={$id}");
        } else {
            $this->Dados['created'] = date('Y-m-d H:i:s');
            $this->Dados['ano'] = $this->DadosAno;
            $this->Dados['mes_id'] = $this->DadosMes;
            $this->Dados['valor'] = $this->Valor;
            $this->Dados['vencimento'] = $this->DadosAno .'-' . $this->DadosMes .'-01';
            $this->Dados['situacao'] = 1;
            $this->Dados['descricao_id'] = 50;
            $this->Dados['codigo'] = '****';
            $this->Dados['observacao'] = 'IMPORTADO DE CONTA Social';

            $cadEntrada = new \App\adms\Models\helper\AdmsCreate;
            $cadEntrada->exeCreate("cx_saida", $this->Dados);
        }
        //var_dump($this->Dados);
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
