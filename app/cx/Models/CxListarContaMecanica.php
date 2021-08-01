<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarContaMecanica
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarContaMecanica
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 100;
    private $ResultadoPg;

    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    public function listarContaMecanica($PageId = null, $DadosAno = null, $DadosMes = null)
    {
        $this->PageId = (int) $PageId;
        $this->DadosAno = (int) $DadosAno;
        $this->DadosMes = (int) $DadosMes;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-mecanica/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_mec) AS num_result FROM cx_conta_mecanica mec
        INNER JOIN cx_mes m ON m.id_mes=mec.mes_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarContaMecanica = new \App\adms\Models\helper\AdmsRead();
        $listarContaMecanica->fullRead("SELECT mec.*, m.* FROM cx_conta_mecanica mec
        INNER JOIN cx_mes m ON m.id_mes=mec.mes_id
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_mec ASC LIMIT :limit OFFSET :offset", "ano={$this->DadosAno}&id_mes={$this->DadosMes}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarContaMecanica->getResultado();
        return $this->Resultado;
    }

    public function listarContaMecanicaFull($PageId = null)
    {
        $this->PageId = (int) $PageId;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-mecanica/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_mec) AS num_result FROM cx_conta_mecanica mec
        INNER JOIN cx_mes m ON m.id_mes=mec.mes_id");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarContaMecanica = new \App\adms\Models\helper\AdmsRead();
        $listarContaMecanica->fullRead("SELECT mec.*, m.* FROM cx_conta_mecanica mec
        INNER JOIN cx_mes m ON m.id_mes=mec.mes_id
        ORDER BY id_mec ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarContaMecanica->getResultado();
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
            $upPagar->exeUpdate("cx_conta_mecanica", $this->Dados, "WHERE id_mec=:id_mec", "id_mec=" . $this->DadosId);
        }
        if ($this->Pagar == 0) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['situacao'] = 0;
            $upPagar = new \App\adms\Models\helper\AdmsUpdate();
            $upPagar->exeUpdate("cx_conta_mecanica", $this->Dados, "WHERE id_mec=:id_mec", "id_mec=" . $this->DadosId);
        }
    }

    public function atualizar($Valor = null, $DadosAno = null, $DadosMes = null)
    {
        $this->Valor = (string) $Valor;
        $this->DadosMes = (string) $DadosMes;
        $this->DadosAno = (string) $DadosAno;

        $verMecanica = new \App\adms\Models\helper\AdmsRead();
        $verMecanica->fullRead("SELECT * FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        WHERE dc.descricao LIKE '%' :mec '%' AND ano=:ano AND mes_id=:mes_id", "mes_id={$this->DadosMes}&ano={$this->DadosAno}&mec=Mecanica");
        $this->Resultado = $verMecanica->getResultado();
        if ($this->Resultado) {
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $this->Dados['valor'] = $this->Valor;
            $this->Dados['situacao'] = 1;
            $id = $this->Resultado[0]['id_sai'];
            $upAtualizar = new \App\adms\Models\helper\AdmsUpdate();
            $upAtualizar->exeUpdate("cx_saida", $this->Dados, "WHERE id_sai=:id_sai", "id_sai={$id}");
        } else {
            $this->Dados['created'] = date("Y-m-d H:i:s");
            $this->Dados['ano'] = $this->DadosAno;
            $this->Dados['mes_id'] = $this->DadosMes;
            $this->Dados['valor'] = $this->Valor;
            $this->Dados['vencimento'] = $this->DadosAno ."-" . $this->DadosMes ."-01";
            $this->Dados['situacao'] = 1;
            $this->Dados['descricao_id'] = 29;
            $this->Dados['codigo'] = '****';
            $this->Dados['observacao'] = 'IMPORTADO DE CONTA MECANICA';

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
