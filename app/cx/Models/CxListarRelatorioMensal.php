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
        $listarEntrada = new \App\adms\Models\helper\AdmsRead();
        $listarEntrada->fullRead("SELECT sai.*, cat.categoria, dc.descricao FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        INNER JOIN cx_categoria cat ON cat.id_cat=dc.categoria_id
        ORDER BY id_sai ASC");
        $this->Resultado = $listarEntrada->getResultado();
        return $this->Resultado;
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
