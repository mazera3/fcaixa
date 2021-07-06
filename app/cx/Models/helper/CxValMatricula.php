<?php

namespace App\cx\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxValMatricula
 *
 * @copyright (c) year, Édio Mazera
 */
class CxValMatricula
{

    private $Matricula;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function valMatricula($Matricula, $EditarUnico = null, $DadoId = null)
    {
        $this->Matricula = (string) $Matricula;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valMatricula = new \App\adms\Models\helper\AdmsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valMatricula->fullRead("SELECT leitor_id FROM bib_leitor WHERE cod_barras_leitor =:cod_barras_leitor AND leitor_id <>:leitor_id LIMIT :limit", "cod_barras_leitor={$this->Matricula}&limit=1&leitor_id={$this->DadoId}");            
        }else{
            $valMatricula->fullRead("SELECT leitor_id FROM bib_leitor WHERE cod_barras_leitor =:cod_barras_leitor LIMIT :limit", "cod_barras_leitor={$this->Matricula}&limit=1");
        }        
        $this->Resultado = $valMatricula->getResultado();
        if (!empty($this->Resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Esta matricula já está cadastrada!</div>";
            $this->Resultado = false;
        } else {
            $this->valCarctMatricula();
        }
    }

    private function valCarctMatricula()
    {
        if (stristr($this->Matricula, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Caracter ( ' ) utilizado na matricula inválido!</div>";
            $this->Resultado = false;
        } else {
            if (stristr($this->Matricula, " ")) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Proibido utilizar espaço em branco na matricula!</div>";
                $this->Resultado = false;
            } else {
                $this->valExtensMatricula();
            }
        }
    }

    private function valExtensMatricula()
    {
        if ((strlen($this->Matricula)) < 6) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A matricula deve ter no mínimo 6 caracteres!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
