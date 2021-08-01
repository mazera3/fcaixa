<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxListarSaida
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarSaida {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 100;
    private $ResultadoPg;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function listarSaida($PageId = null,$DadosAno = null,$DadosMes = null) 
    {
        $this->PageId = (int) $PageId;
        $this->DadosAno = (int) $DadosAno;
        $this->DadosMes = (int) $DadosMes;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'saida/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_sai) AS num_result FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id");
        $this->ResultadoPg = $paginacao->getResultado();
        
        $listarSaida = new \App\adms\Models\helper\AdmsRead();
        $listarSaida->fullRead("SELECT sai.*, cat.categoria, dc.descricao, m.id_mes, m.mes FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        INNER JOIN cx_mes m ON m.id_mes=sai.mes_id
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_sai ASC LIMIT :limit OFFSET :offset", "ano={$this->DadosAno}&id_mes={$this->DadosMes}&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarSaida->getResultado();
        return $this->Resultado;
    }

    public function listarSaidaFull($PageId = null) 
    {
        $this->PageId = (int) $PageId;

        $paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'saida/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id_sai) AS num_result FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id");
        $this->ResultadoPg = $paginacao->getResultado();
        
        $listarSaida = new \App\adms\Models\helper\AdmsRead();
        $listarSaida->fullRead("SELECT sai.*, cat.categoria, dc.descricao, m.mes, m.id_mes FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        INNER JOIN cx_mes m ON m.id_mes=sai.mes_id
        ORDER BY id_sai ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarSaida->getResultado();
        return $this->Resultado;
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
