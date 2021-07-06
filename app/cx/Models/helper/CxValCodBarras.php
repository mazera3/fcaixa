<?php

namespace App\cx\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxValCodBarras
 *
 * @copyright (c) year, Édio Mazera
 */
class CxValCodBarras
{

    private $CodBarras;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function valCodBarras($CodBarras, $EditarUnico = null, $DadoId = null)
    {
        $this->CodBarras = (string) $CodBarras;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valCodBarras = new \App\adms\Models\helper\AdmsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valCodBarras->fullRead("SELECT cop_id FROM bib_copia WHERE cod_bar =:cod_bar AND cop_id <>:cop_id LIMIT :limit", "cod_bar={$this->CodBarras}&limit=1&cop_id={$this->DadoId}");            
        }else{
            $valCodBarras->fullRead("SELECT cop_id FROM bib_copia WHERE cod_bar =:cod_bar LIMIT :limit", "cod_bar={$this->CodBarras}&limit=1");
        }        
        $this->Resultado = $valCodBarras->getResultado();
        if (!empty($this->Resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este código já existe, escolha ouro!</div>";
            $this->Resultado = false;
        } else {
            $this->valCarctCodBarras();
        }
    }

    private function valCarctCodBarras()
    {
        if (stristr($this->CodBarras, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Caracter ( ' ) utilizado no código inválido!</div>";
            $this->Resultado = false;
        } else {
            if (stristr($this->CodBarras, " ")) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Proibido utilizar espaço em branco no código!</div>";
                $this->Resultado = false;
            } else {
                $this->valExtensCodBarras();
            }
        }
    }

    private function valExtensCodBarras()
    {
        if ((strlen($this->CodBarras)) < 4) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O código deve ter no mínimo 4 caracteres!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
